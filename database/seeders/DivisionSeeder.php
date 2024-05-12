<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sql="INSERT INTO `divisions` VALUES
        (1, 'Este', 1),
        (2, 'Norte', 1),
        (3, 'Sur', 1),
        (4, 'Oeste', 1),
        (5, 'Este', 2),
        (6, 'Norte', 2),
        (7, 'Sur', 2),
        (8, 'Oeste', 2);";

        DB::update($sql);
    }
}
