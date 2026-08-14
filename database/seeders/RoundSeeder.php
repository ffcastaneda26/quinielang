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
            ('2026-09-09','2026-09-14','Regular',1,1,1),
            ('2026-09-17','2026-09-21','Regular',1,1,1),
            ('2026-09-24','2026-09-28','Regular',1,1,1),
            ('2026-10-01','2026-10-05','Regular',1,1,1),
            ('2026-10-08','2026-10-12','Regular',1,1,1),
            ('2026-10-15','2026-10-19','Regular',1,1,1),
            ('2026-10-22','2026-10-26','Regular',1,1,1),
            ('2026-10-29','2026-11-02','Regular',1,1,1),
            ('2026-11-05','2026-11-09','Regular',1,1,1),
            ('2026-11-12','2026-11-16','Regular',1,1,1),
            ('2026-11-19','2026-11-23','Regular',1,1,1),
            ('2026-11-25','2026-11-30','Regular',1,1,1),
            ('2026-12-03','2026-12-07','Regular',1,1,1),
            ('2026-12-10','2026-12-14','Regular',1,1,1),
            ('2026-12-17','2026-12-21','Regular',1,1,1),
            ('2026-12-24','2026-12-28','Regular',1,1,1),
            ('2026-12-31','2027-01-04','Regular',1,1,1),
            ('2027-01-09','2027-01-10','Regular',1,1,1);";

        DB::update($sql);
        $this->command->info(PHP_EOL . 'Jornadas Creadas...');
    }
}
