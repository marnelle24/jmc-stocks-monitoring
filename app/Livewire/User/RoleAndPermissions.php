<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleAndPermissions extends Component
{
    public $selectedRole;
    public $user;
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
        $this->resetErrorBag();
        $this->resetValidation();
        $this->getAllPermissions();
        $this->getAllRoles();

        $this->user = User::find($user['id']);
        $this->uname = $this->user->name;
        $this->selectedRole = $this->user->roles[0]->id;
        $this->updatedSelectedRole();
        
        $this->isOpen = true;
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

    public function changeUserRole()
    {
        $role = Role::find($this->selectedRole);

        //Dont execute if no changes
        if($role->name === $this->user->roles[0]->name) return;
        
        $this->user->syncRoles($role->name);
        $this->dispatch('successLabel', message: 'New role succssfully assign to user.');
    }

    public function getAllPermissions()
    {
        $this->allPermissions = Permission::all();
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

    public function updatedSelectedRole()
    {   
        $role = Role::find($this->selectedRole);
        $this->role_permissions = $role ? $role->permissions->pluck('name', 'id')->toArray() : [];
    }    


    public function hide()
    {
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.user.role-and-permissions', [
            
        ]);
    }
}
