<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleAndPermissions extends Component
{
    public $userRole = [];
    public $selectedRole;
    public $viewRole;
    public $usr;
    public $uname;
    public $role_permissions;
    public $allRoles = [];
    public $allPermissions = [];
    public $newPermission;
    public $isCreateNewRole = false;
    public $newRole;

    public $isEdit = false;

    public $isOpen = false;

    protected $listeners = [
        'openRolePermissionModal' => 'show'
    ];

    public function show($user)
    {

        $this->usr = $user;
        $this->userRole = Collect($user['roles'])->pluck('name')->toArray();
        $this->uname = $user['name'];
        
        $this->allPermissions = Permission::all();

        $this->viewRolePermissions();

        $this->resetErrorBag();
        $this->resetValidation();
        $this->getAllRoles();
        // $this->updatedSelectedRole();
        
        $this->isOpen = true;
    }

    public function removeRole($role)
    {
        $user = User::find($this->usr['id']);
        $user->removeRole($role);

        $this->viewRolePermissions();

        $this->userRole = $user->roles->pluck('name')->toArray();

        if(!$user->hasRole($role))
            $this->dispatch('successLabel', message: 'New role succssfully created.');
        else
            $this->dispatch('errorLabel', message: 'Error removing the permission.');
    }

    public function addNewRole()
    {
        $this->validate([
            'newRole' => 'required'
        ]);
        $adminRole = Role::create(['name' => $this->newRole, 'guard_name' => 'web']);

        $this->isCreateNewRole = false;
        $this->getAllRoles();
        $this->dispatch('successLabel', message: 'New role succssfully created.');
    }

    public function isAddNewRole()
    {
        $this->isCreateNewRole = !$this->isCreateNewRole;
    }

    public function addUserRole()
    {
        if(! $this->selectedRole) return;

        $role = Role::find($this->selectedRole);
        $user = User::find($this->usr['id']);
        $user->assignRole($role->name);
        $this->userRole[] = $role->name;
        $this->viewRolePermissions();
        $this->dispatch('successLabel', message: 'New role succssfully assign to user.');
    }

    public function getAllRoles()
    {
        $this->allRoles = Role::all();
    }

    public function addNewPermission()
    {
        $this->validate([
            'newPermission' => 'required'
        ]);

        $role = Role::find($this->selectedRole);
        $newPermission = Permission::create(['name' => $this->newPermission, 'guard_name' => $role->guard_name]);

        $this->newPermission = '';
        
        $role->givePermissionTo($newPermission);
        
        $this->getAllPermissions();
        $this->updatedSelectedRole();

        $this->dispatch('successLabel', message: 'New permission added successfully.');
    }

    public function assignPermissionToUser($permission)
    {
        $_perm = json_decode($permission, true);
        $user = User::find($this->usr['id']);
        $user->givePermissionTo($_perm['name']);
        $this->dispatch('successLabel', message: 'New permission added to a user successfully.');
    }

    public function assignPermissionToRole($permission)
    {
        $role = Role::find($this->selectedRole);

        if ($role->hasPermissionTo($permission['name'])) 
            $role->revokePermissionTo($permission['name']);
        else 
            $role->givePermissionTo($permission['name']);

        $this->updatedSelectedRole();
        $this->dispatch('successLabel', message: 'Roles & permissions updated successfully.');
    }

    public function viewRolePermissions()
    {
        $user = User::find($this->usr['id']);

        // Step 1: Get all permissions that come from the user's roles
        $rolePermissions = $user->roles->map(function ($role) {
            return $role->permissions->pluck('name');
        })->flatten()->unique();

        // Step 2: Get all permissions that are directly assigned to the user
        $directPermissions = $user->permissions->pluck('name');

        // Step 3: Find permissions that are directly assigned and not in the roles
        $permissionsNotInRoles = $directPermissions->diff($rolePermissions);

        // Step 4: Merge the role permissions with the direct (non-role) permissions
        $allPermissions = $rolePermissions->merge($permissionsNotInRoles);

        // Return the final merged permissions array
        $permissionsArray = $allPermissions->toArray();

        $this->role_permissions = $permissionsArray;
    }


    public function hide()
    {
        $this->allPermissions = [];
        $this->usr = [];
        $this->resetErrorBag();
        $this->resetValidation();
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.user.role-and-permissions', [
            
        ]);
    }
}
