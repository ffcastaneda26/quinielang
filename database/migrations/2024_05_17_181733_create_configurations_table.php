<?php

use App\Models\Team;
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
        Schema::create('configuration', function (Blueprint $table) {
            $table->id();
            $table->string('website_name',100)->comment('Nombre del website');
            $table->string('website_url',100)->nullable()->comment('Url');
            $table->string('email')->nullable()->comment('Correo');
            $table->integer('minuts_before_picks')->default(5)->comment('Minutos antes para pronóstico');
            $table->integer('minuts_before_survivors')->default(5)->comment('Minutos antes para survivors');
            $table->boolean('allow_ties')->default(0)->comment('¿Permitir empate?');
            $table->boolean('create_mssing_picks')->default(0)->comment('¿Crear pronósticos faltantes?');
            $table->boolean('assig_role_to_user')->default(1)->comment('¿Asignar Rol al registrarse?');
            $table->boolean('require_points_in_picks')->default(0)->comment('¿Solicitar puntos en pronósticos?');
            $table->string('language',2)->nullable()->default('es')->comment('Idioma');
            $table->boolean('active')->default(1)->comment('¿Activa?');
            $table->string('image')->nullable()->default(null)->comment('Image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuration');
    }
};
