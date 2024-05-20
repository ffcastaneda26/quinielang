<?php

use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('picks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->comment('Jugador');
            $table->foreignIdFor(Game::class)->comment('Partido');
            $table->tinyInteger('winner')->nullable()->default(null)->comment('Ganador');
            $table->boolean('hit_game')->nullable()->default(null)->comment('¿Acertó?');
            $table->integer('visit_points')->nullable()->default(null)->comment('Puntos Visita');
            $table->integer('local_points')->nullable()->default(null)->comment('Puntos Local');
            $table->integer('dif_points_winner')->nullable()->default(null)->comment('Diferencia de puntos con ganador');
            $table->integer('dif_points_total')->nullable()->default(null)->comment('Diferencia de puntos con total');
            $table->integer('dif_points_local')->nullable()->default(null)->comment('Diferencia de puntos con lotal');
            $table->integer('dif_points_visit')->nullable()->default(null)->comment('Diferencia de puntos con visita');
            $table->tinyInteger('hit_last_game')->nullable()->default(null)->comment('¿Acertó último partido');
            $table->boolean('hit_local')->nullable()->default(null)->comment('¿Acertó local');
            $table->boolean('hit_visit')->nullable()->default(null)->comment('¿Acertó visita');
            $table->integer('dif_victory')->nullable()->default(null)->comment('Dif absoluta puntos total del partido - puntos totales pronosticados');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('picks');
    }
};
