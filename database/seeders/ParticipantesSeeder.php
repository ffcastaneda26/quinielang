<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParticipantesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->warn(PHP_EOL . 'Creando Participantes...');
        $usuarios = [
            ['name'=>'Luis Antonio De Jesús Castañeda Jáquez','email'=>'luandeje@yahoo.com.mx','alias'=>'Luck'],
            ['name'=>'Jesús Aaron Delgado Jáquez','email'=>'jesusaaron.delgado@gmail.com','alias'=>'Aaron'],
            ['name'=>'Adrian Heberto Vazquez Jáquez','email'=>'adrian.vazquez.j@gmail.com','alias'=>'Adrian'],
            ['name'=>'Alex','email'=>'alopez@autronic.com.mx','alias'=>'Alex'],
            ['name'=>'Avila','email'=>'a_uriel50@hotmail.com','alias'=>'Avila'],
            ['name'=>'Barry','email'=>'barryents@gmail.com','alias'=>'Barry'],
            ['name'=>'Steeler','email'=>'hna00@hotmail.com','alias'=>'Steeler'],
            ['name'=>'Cesar Emmanuel Castañeda Jáquez','email'=>'cezarcaztaneda@gmail.com','alias'=>'Cesar'],
            ['name'=>'Derby','email'=>'dsvidcjaquez@gmail.com','alias'=>'Derby'],
            ['name'=>'Gabo','email'=>'cgabrieltorres@gmail.com','alias'=>'Gabo'],
            ['name'=>'Fitoc','email'=>'rgarcia@demek.com','alias'=>'FitoC'],
            ['name'=>'Drewb','email'=>'carlos2465@hotmail.com','alias'=>'DrewB'],
            ['name'=>'Fern','email'=>'jfernando.nevarez@gmail.com','alias'=>'FerN'],
            ['name'=>'Gaby','email'=>'ing.gabrielacalderon@icloud.com','alias'=>'Gaby'],
            ['name'=>'Rich','email'=>'luandeje.usa@gmail.com','alias'=>'Rich'],
            ['name'=>'Glommer','email'=>'cvillasana@outlook.com','alias'=>'Glommer'],
            ['name'=>'Arthur','email'=>'aalvarez_saint@hotmail.com','alias'=>'Arthur'],
            ['name'=>'Team23','email'=>'abm23wizard@hotmail.com','alias'=>'Team23'],
            ['name'=>'Jaje','email'=>'jlopez@autronic.com.mx','alias'=>'JAJE'],
            ['name'=>'Ironj','email'=>'juandam1971@gmail.com','alias'=>'IronJ'],
            ['name'=>'Marco','email'=>'macnav_wolf@hotmail.com','alias'=>'Marco'],
            ['name'=>'Martin','email'=>'myanez@autronic.com.mx','alias'=>'Martin'],
            ['name'=>'Mike','email'=>'m.consol@hotmail.com','alias'=>'Mike'],
            ['name'=>'Muñoz','email'=>'amunoz@autronic.com.mx','alias'=>'Muñoz'],
            ['name'=>'Nolasco','email'=>'danielnolasco_14@hotmail.com','alias'=>'Nolasco'],
            ['name'=>'Omar','email'=>'cpcncholo_53@live.com','alias'=>'Omar'],
            ['name'=>'Santos','email'=>'smiranda@autronic.com.mx','alias'=>'Santos'],
            ['name'=>'Eldar','email'=>'eldarom@hotmail.com','alias'=>'Eldar'],
            ['name'=>'Samy','email'=>'samy_cr9@hotmail.com','alias'=>'Samy'],
            ['name'=>'Cecy','email'=>'ceciliamendoza94@hotmail.com','alias'=>'Cecy'],
            ['name'=>'Fer8A','email'=>'fernandorock777@gmail.com','alias'=>'Fer8A'],
            ['name'=>'Pelon','email'=>'macias.acosta.76@hotmail.com','alias'=>'Pelon'],
            ['name'=>'Laïa','email'=>'laurabalderrama18@gmail.com','alias'=>'Laïa'],
            ['name'=>'Hemd','email'=>'hemd78@gmail.com','alias'=>'HEMD'],
            ['name'=>'Karson','email'=>'kquirozc88@gmail.com','alias'=>'Karson'],
            ['name'=>'Charly','email'=>'charly1003@gmail.com','alias'=>'Charly'],
            ['name'=>'Bibaldo','email'=>'arevalo.bibaldoj@gmail.com','alias'=>'Bibaldo'],
            ['name'=>'Stef','email'=>'stefhany.uggo@hotmail.com','alias'=>'Stef'],                     
        ];

        if(count($usuarios)){
            foreach ($usuarios as $usuario) {
                $exists = User::where('email',$usuario['email'])->exists();
                if(!$exists){
                    $user = User::create([
                        "name"      => $usuario['name'],
                        "email"     => $usuario['email'],
                        "password"  => bcrypt("password"),
                        "alias"     => $usuario['alias'],
                        "active"    => 1
                    ])->assignRole(env('ROLE_PARTICIPANT','Participante'));
                }
            }
        }

        $this->command->info('Los Participantes han han Sido Creados');

    }


}
