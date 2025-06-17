<?php
// database/seeders/RoleSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Buat peran admin dan user
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // Buat izin
        $permissions = [
            'manage-songs',
            'manage-composers',
            'manage-users',
            'listen-music'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Berikan semua izin ke admin
        $adminRole->givePermissionTo($permissions);
        
        // Berikan izin mendengarkan musik ke user
        $userRole->givePermissionTo('listen-music');
    }
}
