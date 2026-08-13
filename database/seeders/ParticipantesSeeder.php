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
            ['name' => 'Luis Antonio De Jesús Castañeda Jáquez', 'email' => 'luandeje@yahoo.com.mx', 'alias' => 'Luck', 'username' => 'luandeje'],
            ['name' => 'Jesús Aaron Delgado Jáquez', 'email' => 'jesusaaron.delgado@gmail.com', 'alias' => 'Aaron', 'username' => 'jesusaaron'],
            ['name' => 'Adrian Heberto Vazquez Jáquez', 'email' => 'adrian.vazquez.j@gmail.com', 'alias' => 'Adrian', 'username' => 'adrian'],
            ['name' => 'Alex', 'email' => 'alopez@autronic.com.mx', 'alias' => 'Alex', 'username' => 'alex'],
            ['name' => 'Avila', 'email' => 'a_uriel50@hotmail.com', 'alias' => 'Avila', 'username' => 'avila'],
            ['name' => 'Barry', 'email' => 'barryents@gmail.com', 'alias' => 'Barry', 'username' => 'barry'],
            ['name' => 'Steeler', 'email' => 'hna00@hotmail.com', 'alias' => 'Steeler', 'username' => 'steeler'],
            ['name' => 'Cesar', 'email' => 'cesar.castañeda@gmail.com', 'alias' => 'Cesar', 'username' => 'cesar'],
            ['name' => 'Cesar Emmanuel Castañeda Jáquez', 'email' => 'cezarcaztaneda@gmail.com', 'alias' => 'Cesar', 'username' => 'cesar'],
            ['name' => 'Derby', 'email' => 'dsvidcjaquez@gmail.com', 'alias' => 'Derby', 'username' => 'derby'],
            ['name' => 'Gabo', 'email' => 'cgabrieltorres@gmail.com', 'alias' => 'Gabo', 'username' => 'gabo'],
            ['name' => 'Fitoc', 'email' => 'rgarcia@demek.com', 'alias' => 'FitoC', 'username' => 'fitoc'],
            ['name' => 'Fern', 'email' => 'jfernando.nevarez@gmail.com', 'alias' => 'FerN', 'username' => 'fern'],
            ['name' => 'Gabo', 'email' => 'cgabrieltorres@gmail.com', 'alias' => 'Gabo', 'username' => 'gabo'],
            ['name' => 'Gaby', 'email' => 'ing.gabrielacalderon@icloud.com', 'alias' => 'Gaby', 'username' => 'gaby'],
            ['name' => 'Rich', 'email' => 'luandeje.usa@gmail.com', 'alias' => 'Rich', 'username' => 'rich'],
            ['name' => 'Glommer', 'email' => 'cvillasana@outlook.com', 'alias' => 'Glommer', 'username' => 'glommer'],
            ['name' => 'Arthur', 'email' => 'aalvarez_saint@hotmail.com', 'alias' => 'Arthur', 'username' => 'arthur'],
            ['name' => 'Team23', 'email' => 'abm23wizard@hotmail.com', 'alias' => 'Team23', 'username' => 'team23'],
            ['name' => 'Jaje', 'email' => 'jlopez@autronic.com.mx', 'alias' => 'JAJE', 'username' => 'jaje'],
            ['name' => 'Jorge', 'email' => 'jorge.garcia@autronic.com.mx', 'alias' => 'Jorge', 'username' => 'jorge'],
            ['name' => 'Ironj', 'email' => 'juandam1971@gmail.com', 'alias' => 'IronJ', 'username' => 'ironj'],
            ['name' => 'Marco', 'email' => 'macnav_wolf@hotmail.com', 'alias' => 'Marco', 'username' => 'marco'],
            ['name' => 'Martin', 'email' => 'myanez@autronic.com.mx', 'alias' => 'Martin', 'username' => 'martin'],
            ['name' => 'Mike', 'email' => 'm.consol@hotmail.com', 'alias' => 'Mike', 'username' => 'mike'],
            ['name' => 'Muñoz', 'email' => 'amunoz@autronic.com.mx', 'alias' => 'Muñoz', 'username' => 'munoz'],
            ['name' => 'Nando', 'email' => 'nando.garcia@autronic.com.mx', 'alias' => 'Nando', 'username' => 'nando'],
            ['name' => 'Nolasco', 'email' => 'danielnolasco_14@hotmail.com', 'alias' => 'Nolasco', 'username' => 'nolasco'],
            ['name' => 'Omar', 'email' => 'cpcncholo_53@live.com', 'alias' => 'Omar', 'username' => 'omar'],
            ['name' => 'Santos', 'email' => 'smiranda@autronic.com.mx', 'alias' => 'Santos', 'username' => 'santos'],
            ['name' => 'Eldar', 'email' => 'eldarom@hotmail.com', 'alias' => 'Eldar', 'username' => 'eldar'],
            ['name' => 'Samy', 'email' => 'samy_cr9@hotmail.com', 'alias' => 'Samy', 'username' => 'samy'],
            ['name' => 'Cecy', 'email' => 'ceciliamendoza94@hotmail.com', 'alias' => 'Cecy', 'username' => 'cecy'],
            ['name' => 'Fer8A', 'email' => 'fernandorock777@gmail.com', 'alias' => 'Fer8A', 'username' => 'fer8a'],
            ['name' => 'Jorge', 'email' => 'jorge.garcia@autronic.com.mx', 'alias' => 'Jorge', 'username' => 'jorge'],
            ['name' => 'Pelon', 'email' => 'macias.acosta.76@hotmail.com', 'alias' => 'Pelon', 'username' => 'pelon'],
            ['name' => 'Laïa', 'email' => 'laurabalderrama18@gmail.com', 'alias' => 'Laïa', 'username' => 'laila'],
            ['name' => 'Hemd', 'email' => 'hemd78@gmail.com', 'alias' => 'HEMD', 'username' => 'hemd'],
            ['name' => 'Karson', 'email' => 'kquirozc88@gmail.com', 'alias' => 'Karson', 'username' => 'karson'],
            ['name' => 'Jorge', 'email' => 'jorge.garcia@autronic.com.mx', 'alias' => 'Jorge', 'username' => 'jorge'],
            ['name' => 'Charly', 'email' => 'charly1003@gmail.com', 'alias' => 'Charly', 'username' => 'charly'],
            ['name' => 'Bibaldo', 'email' => 'arevalo.bibaldoj@gmail.com', 'alias' => 'Bibaldo', 'username' => 'bibaldo'],
            ['name' => 'Stef', 'email' => 'stefhany.uggo@hotmail.com', 'alias' => 'Stef', 'username' => 'stef'],
        ];

        if (count($usuarios)) {
            foreach ($usuarios as $usuario) {
                $exists = User::where('email', $usuario['email'])->exists();
                if (!$exists) {
                    $user = User::create([
                        "name"      => $usuario['name'],
                        "email"     => $usuario['email'],
                        "password"  => bcrypt("password"),
                        "alias"     => $usuario['alias'],
                        'username'  => $usuario['username'],
                        "active"    => 1
                    ])->assignRole(env('ROLE_PARTICIPANT', 'Participante'));
                }
            }
        }

        $this->command->info('Los Participantes han han Sido Creados');
    }
}
