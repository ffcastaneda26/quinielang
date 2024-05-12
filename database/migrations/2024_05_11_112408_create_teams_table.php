<?php

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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name',50)->comment('Nombre del equipo');
            $table->string('alias',20)->comment('Alias');
            $table->string('short',3)->comment('Corto para reportes');
            $table->string('logo')->nullable()->default(null)->comment('Logotipo');
            $table->string('logo_gris')->nullable()->default(null)->comment('Logotipo Gris');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
