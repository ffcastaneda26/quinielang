<?php

use App\Models\Round;
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
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Round::class)->comment('Jornada');
            $table->foreignIdFor(User::class)->comment('Jugador');
            $table->tinyInteger('hits')->nullable()->default(null)->comment('Aciertos');
            $table->tinyInteger('extra_points')->nullable()->default(null)->comment('Puntos Extra');
            $table->tinyInteger('dif_winner_points')->nullable()->default(null)->comment('Dif Puntos del ganador');
            $table->tinyInteger('dif_total_points')->nullable()->default(null)->comment('Dif total de puntos');
            $table->tinyInteger('dif_local_points')->nullable()->default(null)->comment('Dif Puntos local');
            $table->tinyInteger('dif_visit_points')->nullable()->default(null)->comment('Dif Puntos visitar');
            $table->tinyInteger('dif_victory')->nullable()->default(null)->comment('Dif de la victoria');
            $table->boolean('hit_last_game')->nullable()->default(0)->comment('¿Acertó ultimo juego?');
            $table->boolean('hit_visit')->nullable()->default(0)->comment('¿Acertó al marcador visitante?');
            $table->boolean('hit_local')->nullable()->default(0)->comment('¿Acertó al marcador local');
            $table->integer('position')->nullable()->default(null)->comment('Posición en la jornada');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('positions');
    }
};
