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
        $this->command->warn(PHP_EOL . 'Creando Equipos...');
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('teams')->truncate();
        $sql = "INSERT INTO teams VALUES
        (1,'Dallas ','Cowboys','DAL','teams/DAL.png','teams/DAL_gris.png',1),
        (2,'New York G','Giants','NYG','teams/NYG.png','teams/NYG_gris.png',1),
        (3,'Philadelphia ','Eagles','PHI','teams/PHI.png','teams/PHI_gris.png',1),
        (4,'Washington ','Football','WAS','teams/WAS.png','teams/WAS_gris.png',1),
        (5,'Chicago ','Bears','CHI','teams/CHI.png','teams/CHI_gris.png',2),
        (6,'Detroit ','Lions','DET','teams/DET.png','teams/DET_gris.png',2),
        (7,'Green Bay ','Packers','GB','teams/GB.png','teams/GB_gris.png',2),
        (8,'Minnesota ','Vikings','MIN','teams/MIN.png','teams/MIN_gris.png',2),
        (9,'Atlanta ','Falcons','ATL','teams/ATL.png','teams/ATL_gris.png',3),
        (10,'Carolina ','Panthers','CAR','teams/CAR.png','teams/CAR_gris.png',3),
        (11,'New Orleans ','Saints','NO','teams/NO.png','teams/NO_gris.png',3),
        (12,'Tampa Bay ','Buccaneers','TB','teams/TB.png','teams/TB_gris.png',3),
        (13,'Arizona ','Cardinals','ARI','teams/ARI.png','teams/ARI_gris.png',4),
        (14,'Los Angeles R','Rams','LAR','teams/LA.png','teams/LA_gris.png',4),
        (15,'San Francisco ','49ers','SF','teams/SF.png','teams/SF_gris.png',4),
        (16,'Seattle ','Seahawks','SEA','teams/SEA.png','teams/SEA_gris.png',4),
        (17,'Buffalo ','Bills','BUF','teams/BUF.png','teams/BUF_gris.png',5),
        (18,'Miami ','Dolphins','MIA','teams/MIA.png','teams/MIA_gris.png',5),
        (19,'New England','Patriots','NE','teams/NE.png','teams/NE_gris.png',5),
        (20,'New York J','Jets','NYJ','teams/NYJ.png','teams/NYJ_gris.png',5),
        (21,'Baltimore ','Ravens','BAL','teams/BAL.png','teams/BAL_gris.png',6),
        (22,'Cincinnati ','Bengals','CIN','teams/CIN.png','teams/CIN_gris.png',6),
        (23,'Cleveland ','Browns','CLE','teams/CLE.png','teams/CLE_gris.png',6),
        (24,'Pittsburgh ','Steelers','PIT','teams/PIT.png','teams/PIT_gris.png',6),
        (25,'Houston ','Texans','HOU','teams/HOU.png','teams/HOU_gris.png',7),
        (26,'Indianapolis ','Colts','IND','teams/IND.png','teams/IND_gris.png',7),
        (27,'Jacksonville ','Jaguars','JAX','teams/JAX.png','teams/JAX_gris.png',7),
        (28,'Tennessee ','Titans','TEN','teams/TEN.png','teams/TEN_gris.png',7),
        (29,'Denver ','Broncos','DEN','teams/DEN.png','teams/DEN_gris.png',8),
        (30,'Kansas City ','Chiefs','KC','teams/KC.png','teams/KC_gris.png',8),
        (31,'Las Vegas','Raiders','LAS','teams/LV.png','teams/LV_gris.png',8),
        (32,'Los Angeles C','Chargers','LAC','teams/LAC.png','teams/LA_gris.png',8);";
        DB::update($sql);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); // Desactivamos la revisión de claves foráneas
    }
}
