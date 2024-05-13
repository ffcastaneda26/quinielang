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
        (1, 'Dallas ', 'Cowboys', 'DAL', 'cowboys.png',null,1),
        (2, 'New York G', 'Giants', 'NYG', 'giants.png',null,1),
        (3, 'Philadelphia ', 'Eagles', 'PHI', 'eagles.png',null,1),
        (4, 'Washington ', 'Football', 'WAS', 'redskins.png',null,1),
        (5, 'Chicago ', 'Bears', 'CHI', 'bears.png',null,2),
        (6, 'Detroit ', 'Lions', 'DET', 'lions.png',null,2),
        (7, 'Green Bay ', 'Packers', 'GB', 'packers.png',null,2),
        (8, 'Minnesota ', 'Vikings', 'MIN', 'vikings.png',null,2),
        (9, 'Atlanta ', 'Falcons', 'ATL', 'falcons.png',null,3),
        (10, 'Carolina ', 'Panthers', 'CAR', 'panthers.png',null,3),
        (11, 'New Orleans ', 'Saints', 'NO', 'saints.png',null,3),
        (12, 'Tampa Bay ', 'Buccaneers', 'TB', 'buccaneers.png',null,3),
        (13, 'Arizona ', 'Cardinals', 'ARI', 'cardinals.png',null,4),
        (14, 'Los Angeles R', 'Rams', 'LAR', 'rams.png',null,4),
        (15, 'San Francisco ', '49ers', 'SF', '49ers.png',null,4),
        (16, 'Seattle ', 'Seahawks', 'SEA', 'seahawks.png',null,4),
        (17, 'Buffalo ', 'Bills', 'BUF', 'bills.png',null,5),
        (18, 'Miami ', 'Dolphins', 'MIA', 'dolphins.png',null,5),
        (19, 'New England', 'Patriots', 'NE', 'patriots.png',null,5),
        (20, 'New York J', 'Jets', 'NYJ', 'jets.png',null,5),
        (21, 'Baltimore ', 'Ravens', 'BAL', 'ravens.png',null,6),
        (22, 'Cincinnati ', 'Bengals', 'CIN', 'bengals.png',null,6),
        (23, 'Cleveland ', 'Browns', 'CLE', 'browns.png',null,6),
        (24, 'Pittsburgh ', 'Steelers', 'PIT', 'steelers.png',null,6),
        (25, 'Houston ', 'Texans', 'HOU', 'texans.png',null,7),
        (26, 'Indianapolis ', 'Colts', 'IND', 'colts.png',null,7),
        (27, 'Jacksonville ', 'Jaguars', 'JAX', 'jaguars.png',null,7),
        (28, 'Tennessee ', 'Titans', 'TEN', 'titans.png',null,7),
        (29, 'Denver ', 'Broncos', 'DEN', 'broncos.png',null,8),
        (30, 'Kansas City ', 'Chiefs', 'KC', 'chiefs.png',null,8),
        (31, 'Las Vegas', 'Raiders', 'LAS', 'raiders.png',null,8),
        (32, 'Los Angeles C', 'Chargers', 'LAC', 'chargers.png',null,8),
        (33, 'Bye', 'Bye', 'Bye', 'nacional.png',null,1),
        (34, 'Americana', 'Americana', 'Ame', 'americana.png',null,2),
        (35, 'Nacional', 'Nacional', 'Nac', 'nacional.png',null,2),
        (36, 'San Francisco', 'TBD', 'TBD', 'nflplayofflogo.png',null,2),
        (37, 'Kansas City', 'TBD', 'TBD', 'nflplayofflogo.png',null,2),
        (38, 'TBD', 'TBD', 'TBD', 'nflplayofflogo.png',null,2);";
        DB::update($sql);
    }
}
