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
        Schema::create('conferences', function (Blueprint $table) {
            $table->id();
            $table->string('name',50)->unique()->comment('Nombre');
            $table->string('short',10)->unique()->comment('Nombre Corto');
            $table->string('logo',100)->nullable()->default(null)->comment('Logotipo');
            $table->foreignIdFor(League::class)->liga();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conferences');
    }
};
