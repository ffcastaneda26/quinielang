<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->warn(PHP_EOL . 'Creando Jornadas...');

        DB::table('rounds')->truncate();

        $sql = "INSERT INTO rounds (start,finish,type,active,season_id,survivor_id) VALUES
            ('2025-09-04','2025-09-08','Regular',1,1,1),
            ('2025-09-11','2025-09-15','Regular',1,1,1),
            ('2025-09-18','2025-09-22','Regular',1,1,1),
            ('2025-09-25','2025-09-29','Regular',1,1,1),
            ('2025-10-02','2025-10-06','Regular',1,1,1),
            ('2025-10-09','2025-10-13','Regular',1,1,1),
            ('2025-10-16','2025-10-20','Regular',1,1,1),
            ('2025-10-23','2025-10-27','Regular',1,1,1),
            ('2025-10-30','2025-11-03','Regular',1,1,1),
            ('2025-11-06','2025-11-10','Regular',1,1,1),
            ('2025-11-13','2025-11-17','Regular',1,1,1),
            ('2025-11-20','2025-11-24','Regular',1,1,1),
            ('2025-11-27','2025-12-01','Regular',1,1,1),
            ('2025-12-04','2025-12-08','Regular',1,1,1),
            ('2025-12-11','2025-12-15','Regular',1,1,1),
            ('2025-12-18','2025-12-22','Regular',1,1,1),
            ('2025-12-25','2025-12-29','Regular',1,1,1),
            ('2026-01-04','2026-01-04','Regular',1,1,1);";

        DB::update($sql);
        $this->command->info(PHP_EOL . 'Jornadas Creadas...');
    }
}