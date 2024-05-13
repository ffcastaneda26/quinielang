<?php

use App\Models\League;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seasons', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('name');
            $table->date('start_regular')->nullable()->default(null)->comment('Inicio Temporada Regular');
            $table->date('finish_regular')->nullable()->default(null)->comment('Inicio Temporada Regular');
            $table->date('start_play_offs')->nullable()->default(null)->comment('Inicio Playoffs');
            $table->date('finish_play_offs')->nullable()->default(null)->comment('Inicio Playoffs');
            $table->date('start_conference')->nullable()->default(null)->comment('Inicio Conferencia');
            $table->date('finisht_conference')->nullable()->default(null)->comment('Inicio Conferencia');
            $table->date('super_bowl')->nullable()->default(null)->comment('Superbowl');
            $table->unsignedBigInteger('field_id')->nullable()->default(null)->comment('Campo de equipo del superbowl');
            $table->unsignedBigInteger('champion_ship_id')->nullable()->default(null)->comment('Id Equipo Campeón ');
            $table->integer('champion_ship_points')->nullable()->default(0)->comment('Puntos Campeón');
            $table->unsignedBigInteger('sub_champion_ship_id')->nullable()->default(null)->comment('Id Equipo Sub Campeón ');
            $table->integer('sub_champion_ship_points')->nullable()->default(0)->comment('Puntos Sub Campeón');
            $table->foreignIdFor(League::class)->comment('Liga');
            $table->boolean('active')->default(1)->comment('¿Activa?');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seasons');
    }
};
