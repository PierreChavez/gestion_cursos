<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $teacherRole = Role::create(['name' => 'teacher']);
        $studentRole = Role::create(['name' => 'student']);

        // Create permissions
        Permission::create(['name' => 'create courses']);
        Permission::create(['name' => 'assign courses']);
        Permission::create(['name' => 'register attendances']);
        Permission::create(['name' => 'view own courses']);
        Permission::create(['name' => 'view own attendances']);
        Permission::create(['name' => 'download certificates']);

        // Assign permissions to roles
        $adminRole->givePermissionTo(['create courses', 'assign courses', 'register attendances']);
        $teacherRole->givePermissionTo(['create courses', 'assign courses', 'register attendances']);
        $studentRole->givePermissionTo(['view own courses', 'view own attendances', 'download certificates']);

        // Create admin user
        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // Change 'password' to the desired password
        ]);

        // Assign admin role to the user
        $adminUser->assignRole($adminRole);
    }
}
