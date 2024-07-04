<?php

use App\Models\Round;
use App\Models\Survivor;
use App\Models\Team;
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
        Schema::create('user_survivors', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->comment('Participante');
            $table->foreignIdFor(Round::class)->comment('Jornada');
            $table->foreignIdFor(Team::class)->comment('Equipo');
            $table->foreignIdFor(Survivor::class)->comment('Survivor');
            $table->boolean('survive')->default(0)->comment('¿Sobrevivió?');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_survivors');
    }
};
