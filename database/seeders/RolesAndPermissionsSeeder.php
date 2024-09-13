<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        // Create permissions
        $createPermission = Permission::create(['name' => 'create']);
        $readPermission = Permission::create(['name' => 'read']);
        $updatePermission = Permission::create(['name' => 'update']);
        $deletePermission = Permission::create(['name' => 'delete']);

        // Create roles
        $administratorRole = Role::create(['name' => 'Administrator']);
        $adminRole = Role::create(['name' => 'admin']);
        $guestRole = Role::create(['name' => 'guest']);


        // Assign permissions to roles
        $adminRole->givePermissionTo([$readPermission, $updatePermission, $createPermission, $deletePermission]);
        $guestRole->givePermissionTo($readPermission);

        // Assign roles to users
        $adminUser = User::find(1); // Replace with the correct user ID
        $guestUser = User::find(2); // Replace with the correct user ID

        $adminUser->assignRole('admin');
        $guestUser->assignRole('guest');
    }
}
