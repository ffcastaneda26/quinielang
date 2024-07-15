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
            (1, 'Dallas ', 'Cowboys', 'DAL', 'teams/cowboys.png', 'teams/cowboys.png', 1),
            (2, 'New York G', 'Giants', 'NYG', 'teams/giants.png', 'teams/giants.png', 1),
            (3, 'Philadelphia ', 'Eagles', 'PHI', 'teams/eagles.png', 'teams/eagles.png', 1),
            (4, 'Washington ', 'Football', 'WAS', 'teams/redskins.png', 'teams/redskins.png', 1),
            (5, 'Chicago ', 'Bears', 'CHI', 'teams/bears.png', 'teams/bears.png', 2),
            (6, 'Detroit ', 'Lions', 'DET', 'teams/lions.png', 'teams/lions.png', 2),
            (7, 'Green Bay ', 'Packers', 'GB', 'teams/packers.png', 'teams/packers.png', 2),
            (8, 'Minnesota ', 'Vikings', 'MIN', 'teams/vikings.png', 'teams/vikings.png', 2),
            (9, 'Atlanta ', 'Falcons', 'ATL', 'teams/falcons.png', 'teams/falcons.png', 3),
            (10, 'Carolina ', 'Panthers', 'CAR', 'teams/panthers.png', 'teams/panthers.png', 3),
            (11, 'New Orleans ', 'Saints', 'NO', 'teams/saints.png', 'teams/saints.png', 3),
            (12, 'Tampa Bay ', 'Buccaneers', 'TB', 'teams/buccaneers.png', 'teams/buccaneers.png', 3),
            (13, 'Arizona ', 'Cardinals', 'ARI', 'teams/cardinals.png', 'teams/cardinals.png', 4),
            (14, 'Los Angeles R', 'Rams', 'LAR', 'teams/rams.png', 'teams/rams.png', 4),
            (15, 'San Francisco ', '49ers', 'SF', 'teams/49ers.png', 'teams/49ers.png', 4),
            (16, 'Seattle ', 'Seahawks', 'SEA', 'teams/seahawks.png', 'teams/seahawks.png', 4),
            (17, 'Buffalo ', 'Bills', 'BUF', 'teams/bills.png', 'teams/bills.png', 5),
            (18, 'Miami ', 'Dolphins', 'MIA', 'teams/dolphins.png', 'teams/dolphins.png', 5),
            (19, 'New England', 'Patriots', 'NE', 'teams/patriots.png', 'teams/patriots.png', 5),
            (20, 'New York J', 'Jets', 'NYJ', 'teams/jets.png', 'teams/jets.png', 5),
            (21, 'Baltimore ', 'Ravens', 'BAL', 'teams/ravens.png', 'teams/ravens.png', 6),
            (22, 'Cincinnati ', 'Bengals', 'CIN', 'teams/bengals.png', 'teams/bengals.png', 6),
            (23, 'Cleveland ', 'Browns', 'CLE', 'teams/browns.png', 'teams/browns.png', 6),
            (24, 'Pittsburgh ', 'Steelers', 'PIT', 'teams/steelers.png', 'teams/steelers.png', 6),
            (25, 'Houston ', 'Texans', 'HOU', 'teams/texans.png', 'teams/texans.png', 7),
            (26, 'Indianapolis ', 'Colts', 'IND', 'teams/colts.png', 'teams/colts.png', 7),
            (27, 'Jacksonville ', 'Jaguars', 'JAX', 'teams/jaguars.png', 'teams/jaguars.png', 7),
            (28, 'Tennessee ', 'Titans', 'TEN', 'teams/titans.png', 'teams/titans.png', 7),
            (29, 'Denver ', 'Broncos', 'DEN', 'teams/broncos.png', 'teams/broncos.png', 8),
            (30, 'Kansas City ', 'Chiefs', 'KC', 'teams/chiefs.png', 'teams/chiefs.png', 8),
            (31, 'Las Vegas', 'Raiders', 'LAS', 'teams/raiders.png', 'teams/raiders.png', 8),
            (32, 'Los Angeles C', 'Chargers', 'LAC', 'teams/chargers.png', 'teams/chargers.png', 8),
            (33, 'Bye', 'Bye', 'Bye', 'teams/nacional.png', 'teams/nacional.png', 1),
            (34, 'Americana', 'Americana', 'Ame', 'teams/americana.png', 'teams/americana.png', 2),
            (35, 'Nacional', 'Nacional', 'Nac', 'teams/nacional.png', 'teams/nacional.png', 2),
            (36, 'San Francisco', 'TBD', 'TBD', 'teams/nflplayofflogo.png', 'teams/nflplayofflogo.png', 2),
            (37, 'Kansas City', 'TBD', 'TBD', 'teams/nflplayofflogo.png', 'teams/nflplayofflogo.png', 2),
            (38, 'TBD', 'TBD', 'TBD', 'teams/nflplayofflogo.png', 'teams/nflplayofflogo.png', 2)";
        DB::update($sql);
    }
}
