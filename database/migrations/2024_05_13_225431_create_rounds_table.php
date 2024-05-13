<?php

use App\Models\Season;
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
        Schema::create('rounds', function (Blueprint $table) {
            $table->id();
            $table->date('start')->comment('Fecha de Inicio');
            $table->date('finish')->comment('Fecha de Inicio');
            $table->boolean('active')->default(0)->comment('Activa?');
            $table->string('type')->define('Regular')->comment('Tipo');
            $table->foreignIdFor(Season::class)->comment('Temporada');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rounds');
    }
};
