<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->truncate();

        User::create([
            "name"      => "Administrador General",
            "email"     => "admin@quinielang.com",
            "password"  => bcrypt("adminquinielang"),
            "alias"     => "Admin",
            "active"    => 1
        ])->assignRole('Admin');
    }
}
