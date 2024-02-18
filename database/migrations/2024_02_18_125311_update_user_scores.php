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
        Schema::table('user_scores', function (Blueprint $table) {
            $table->renameColumn('created_at', 'finished_at');
            $table->dropColumn('updated_at');
            $table->timestamp('started_at');
            $table->string('game', 16);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_scores', function (Blueprint $table) {
            $table->renameColumn('finished_at', 'created_at');
            $table->timestamp('updated_at');
            $table->dropColumn(['started_at', 'game']);
        });
    }
};
