<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SurvivorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('survivors')->truncate();
        $sql= "INSERT INTO survivors VALUES
            (1, 'Regular',1),
            (2,'Playoffs',0);";
        DB::update($sql);
    }
}
