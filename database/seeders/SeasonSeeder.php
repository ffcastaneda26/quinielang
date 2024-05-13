<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sql="INSERT INTO seasons VALUES
        (1, 2022, '2022-08-08', '2023-02-27', null, null, null, null, null, 0, 0, 0, 0, 0, 1, 1);";
        DB::update($sql);
    }
}
