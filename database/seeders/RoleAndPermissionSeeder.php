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

        $this->command->warn(PHP_EOL . __('Creating Permissions'));
        // create permissions
        $permissions = [

        ];

        if(count($permissions)){
            foreach ($permissions as $permission) {
                Permission::create(['name' => $permission]);
            }
        }
        $this->command->info(__('Permissions Created'));

        $this->command->info(__('Creating Role Admin'));

        // Admin con todos los permisos
        $role = Role::create(['name' => 'Admin']);
        $this->command->info(__('Admin Role Created'));
        $this->command->info(__('Creating Role Paritipant'));
        $role = Role::create(['name' => 'Participante']);
        $this->command->info(__('Participant Role Created'));


    }
}
