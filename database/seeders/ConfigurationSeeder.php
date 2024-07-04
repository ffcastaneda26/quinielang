<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->warn(PHP_EOL . 'Creando Configuración...');
        $sql="INSERT INTO configuration VALUES
        (1, 'QUINIELA NFL 2024', 'quiniela.life/', 'ffcastaneda@gmail.com', 5,5,0, 1, 1, 0, 'es', 0, 'configuration/logonfl.jpg');";
         DB::update($sql);

        $this->command->info('Configuración Creada');
    }
}
