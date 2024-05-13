<?php

use App\Models\Division;
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
            $table->string('name',50)->unique()->comment('Nombre');
            $table->string('alias',50)->unique()->comment('Alias');
            $table->string('short',3)->unique()->comment('Corto');
            $table->string('logotipo')->nullable()->default(null)->comment('Logo');
            $table->foreignIdFor(Division::class)->comment('División');
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
