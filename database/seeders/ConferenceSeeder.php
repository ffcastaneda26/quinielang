<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sql="INSERT INTO conferences VALUES
        (1, 'Nacional', 'NAL', 'nacional.jpg', 1),
        (2, 'Americana', 'AME', 'americana.jpg', 1);";
        DB::update($sql);
    }
}
