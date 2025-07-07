<?php

use App\Models\Season;
use App\Models\Survivor;
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
        Schema::table('rounds', function (Blueprint $table) {
            $table->foreignIdFor(Season::class)->after('type')->default(1)->comment('Temporada');
            $table->foreignIdFor(Survivor::class)->after('season_id')->default(1)->comment('Survivor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rounds', function (Blueprint $table) {
            $table->dropColumn('season_id');
            $table->dropColumn('survivor_id');
        });
    }
};
