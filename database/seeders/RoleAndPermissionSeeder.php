<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();


        // create permissions
        $permissions = [

        ];

        if(count($permissions)){
            foreach ($permissions as $permission) {
                Permission::create(['name' => $permission]);
            }
        }


        // Admin con todos los permisos
        $role = Role::create(['name' => 'Admin']);
    }
}
