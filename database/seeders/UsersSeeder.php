<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sql="INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`) VALUES
        (2, 'Administrador General', 'admin@admin.com', NULL, 'password', NULL, NULL, NULL, NULL, NULL, NULL),
        (3, 'Norma Lezama', 'norma.lezama@unipagoservices.com', NULL, 'password', NULL, NULL, NULL, NULL, NULL, NULL),
        (4, 'Franquiciatario', 'franquiciatario@unipago.com', NULL, 'password', NULL, NULL, NULL, NULL, NULL, NULL),
        (5, 'David Castaneda Jaquez', 'davidcjaquez@gmail.com', NULL, 'password', NULL, NULL, NULL, NULL, NULL, NULL),
        (6, 'Admin Franquicia', 'franquicia@unipagoservices.com', NULL, 'password', NULL, NULL, NULL, NULL, NULL, NULL);";
        DB::update($sql);


        $sql="INSERT INTO `user_roles` (`role_id`, `model_type`, `model_id`) VALUES (1, 'App\\Models\\User', 1);
            INSERT INTO `user_roles` (`role_id`, `model_type`, `model_id`) VALUES (3, 'App\\Models\\User', 2);
            INSERT INTO `user_roles` (`role_id`, `model_type`, `model_id`) VALUES (2, 'App\\Models\\User', 3);
            INSERT INTO `user_roles` (`role_id`, `model_type`, `model_id`) VALUES (2, 'App\\Models\\User', 4);
            INSERT INTO `user_roles` (`role_id`, `model_type`, `model_id`) VALUES (2, 'App\\Models\\User', 5);
            INSERT INTO `user_roles` (`role_id`, `model_type`, `model_id`) VALUES (3, 'App\\Models\\User', 6);";

        DB::update($sql);

        $users = User::where('email','!=','superadmin@unipagong.com')->update(['password' => bcrypt('password')]);

    }
}
