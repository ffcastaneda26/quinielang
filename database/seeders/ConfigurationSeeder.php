<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sql="INSERT INTO configuration  VALUES
        (1, 'QUINIELA NFL 2024', 'quiniela.life/', 'ffcastaneda@gmail.com', 5, 0, 1, 1, 0, 'es', 1,null);";
        DB::update($sql);
    }
}
