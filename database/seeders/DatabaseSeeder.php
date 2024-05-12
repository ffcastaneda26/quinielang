<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->truncateTables([
            'user_roles',
            'role_permissions',
            'user_permissions',
            'users',
            'roles',
            'permissions',
            'leagues',
            'conferences',
        ]);

        $this->call(RoleAndPermissionSeeder::class);
        $this->call(UserAdminTableSeeder::class);
        $this->call(LeagueSeeder::class);
        $this->call(ConferenceSeeder::class);
    }

    protected function truncateTables(array $tables) {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); // Desactivamos la revisión de claves foráneas
    }
}
