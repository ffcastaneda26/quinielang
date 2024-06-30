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
        Schema::create('survivors', function (Blueprint $table) {
            $table->id();
            $table->string('name',20)->default('Regular')->comment('Survivor');
            $table->boolean('active')->default(0)->comment('¿Activo?');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survivors');
    }
};
