<?php

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
        Schema::create('general_positions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->comment('Jugador');
            $table->smallInteger('hits')->nullable()->dafault(0)->comment('Aciertos');
            $table->smallInteger('hits_breaker')->nullable()->dafault(0)->comment('Partidos de desmpate acertados');
            $table->smallInteger('total_error')->nullable()->dafault(null)->comment('Acumulado(resultado partido - pronosticado)');
            $table->smallInteger('total_points')->nullable()->dafault(null)->comment('Puntos Totales');
            $table->smallInteger('position')->nullable()->dafault(0)->comment('Posición en tabla general');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_positions');
    }
};
