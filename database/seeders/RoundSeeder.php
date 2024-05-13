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
        $sql="INSERT INTO rounds VALUES
        (1, '2023-08-01 12:00:00', '2023-09-12 12:00:00', 0, 'Regular', 1),
        (2, '2023-09-13 12:00:00', '2023-09-19 12:00:00', 0, 'Regular', 1),
        (3, '2023-09-20 12:00:00', '2023-09-26 12:00:00', 0, 'Regular', 1),
        (4, '2023-09-27 12:00:00', '2023-10-03 12:00:00', 0, 'Regular', 1),
        (5, '2023-10-04 12:00:00', '2023-10-10 12:00:00', 0, 'Regular', 1),
        (6, '2023-10-18 17:23:29', '2023-10-17 06:00:00', 0, 'Regular', 1),
        (7, '2023-10-18 06:00:00', '2023-10-24 12:00:00', 0, 'Regular', 1),
        (8, '2023-10-25 12:00:00', '2023-10-31 12:00:00', 0, 'Regular', 1),
        (9, '2023-11-01 12:00:00', '2023-11-07 14:00:00', 0, 'Regular', 1),
        (10, '2023-11-08 14:00:00', '2023-11-14 14:00:00', 0, 'Regular', 1),
        (11, '2023-11-15 14:00:00', '2023-11-21 14:00:00', 0, 'Regular', 1),
        (12, '2023-11-22 14:00:00', '2023-11-28 14:00:00', 0, 'Regular', 1),
        (13, '2023-11-29 14:00:00', '2023-12-05 14:00:00', 0, 'Regular', 1),
        (14, '2023-12-06 14:00:00', '2023-12-12 14:00:00', 0, 'Regular', 1),
        (15, '2023-12-13 14:00:00', '2023-12-19 14:00:00', 0, 'Regular', 1),
        (16, '2023-12-20 14:00:00', '2023-12-26 14:00:00', 0, 'Regular', 1),
        (17, '2023-12-27 14:00:00', '2024-01-02 14:00:00', 0, 'Regular', 1),
        (18, '2024-01-03 14:00:00', '2024-01-09 14:00:00', 0, 'Regular', 1),
        (19, '2024-01-10 14:00:00', '2024-02-29 14:00:00', 0, 'Regular', 1);";
        DB::update($sql);
    }
}
