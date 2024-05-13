<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sql="INSERT INTO teams VALUES
        (1, 'Dallas ', 'Cowboys', 'DAL', 'cowboys.png', 1),
        (2, 'New York G', 'Giants', 'NYG', 'giants.png', 1),
        (3, 'Philadelphia ', 'Eagles', 'PHI', 'eagles.png', 1),
        (4, 'Washington ', 'Football', 'WAS', 'redskins.png', 1),
        (5, 'Chicago ', 'Bears', 'CHI', 'bears.png', 2),
        (6, 'Detroit ', 'Lions', 'DET', 'lions.png', 2),
        (7, 'Green Bay ', 'Packers', 'GB', 'packers.png', 2),
        (8, 'Minnesota ', 'Vikings', 'MIN', 'vikings.png', 2),
        (9, 'Atlanta ', 'Falcons', 'ATL', 'falcons.png', 3),
        (10, 'Carolina ', 'Panthers', 'CAR', 'panthers.png', 3),
        (11, 'New Orleans ', 'Saints', 'NO', 'saints.png', 3),
        (12, 'Tampa Bay ', 'Buccaneers', 'TB', 'buccaneers.png', 3),
        (13, 'Arizona ', 'Cardinals', 'ARI', 'cardinals.png', 4),
        (14, 'Los Angeles R', 'Rams', 'LAR', 'rams.png', 4),
        (15, 'San Francisco ', '49ers', 'SF', '49ers.png', 4),
        (16, 'Seattle ', 'Seahawks', 'SEA', 'seahawks.png', 4),
        (17, 'Buffalo ', 'Bills', 'BUF', 'bills.png', 5),
        (18, 'Miami ', 'Dolphins', 'MIA', 'dolphins.png', 5),
        (19, 'New England', 'Patriots', 'NE', 'patriots.png', 5),
        (20, 'New York J', 'Jets', 'NYJ', 'jets.png', 5),
        (21, 'Baltimore ', 'Ravens', 'BAL', 'ravens.png', 6),
        (22, 'Cincinnati ', 'Bengals', 'CIN', 'bengals.png', 6),
        (23, 'Cleveland ', 'Browns', 'CLE', 'browns.png', 6),
        (24, 'Pittsburgh ', 'Steelers', 'PIT', 'steelers.png', 6),
        (25, 'Houston ', 'Texans', 'HOU', 'texans.png', 7),
        (26, 'Indianapolis ', 'Colts', 'IND', 'colts.png', 7),
        (27, 'Jacksonville ', 'Jaguars', 'JAX', 'jaguars.png', 7),
        (28, 'Tennessee ', 'Titans', 'TEN', 'titans.png', 7),
        (29, 'Denver ', 'Broncos', 'DEN', 'broncos.png', 8),
        (30, 'Kansas City ', 'Chiefs', 'KC', 'chiefs.png', 8),
        (31, 'Las Vegas', 'Raiders', 'LAS', 'raiders.png', 8),
        (32, 'Los Angeles C', 'Chargers', 'LAC', 'chargers.png', 8),
        (33, 'Bye', 'Bye', 'Bye', 'nacional.png', 1),
        (34, 'Americana', 'Americana', 'Ame', 'americana.png', 2),
        (35, 'Nacional', 'Nacional', 'Nac', 'nacional.png', 2),
        (36, 'San Francisco', 'TBD', 'TBD', 'nflplayofflogo.png', 2),
        (37, 'Kansas City', 'TBD', 'TBD', 'nflplayofflogo.png', 2),
        (38, 'TBD', 'TBD', 'TBD', 'nflplayofflogo.png', 2);";
        DB::update($sql);
    }
}
