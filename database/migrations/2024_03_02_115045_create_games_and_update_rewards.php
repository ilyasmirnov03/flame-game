<?php

use App\Models\Game;
use App\Models\Language;
use App\Models\Reward;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('label', 16)->unique();
            $table->string('image', 24);
        });

        Schema::create('game_translations', function (Blueprint $table) {
            $table->id();
            $table->string('title', 32);
            $table->text('description');
            $table->foreignIdFor(Game::class);
            $table->foreignIdFor(Language::class);
        });

        Schema::table('rewards', function (Blueprint $table) {
            $table->renameColumn('name', 'label');
            $table->dropColumn(['description']);
        });

        Schema::create('reward_translations', function (Blueprint $table) {
            $table->id();
            $table->string('title', 16);
            $table->text('description');
            $table->foreignIdFor(Reward::class);
            $table->foreignIdFor(Language::class);
        });

        Schema::table('user_scores', function (Blueprint $table) {
            $table->dropColumn('game');
            $table->foreignIdFor(Game::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_translations');
        Schema::dropIfExists('games');
        Schema::dropIfExists('reward_translations');
        Schema::table('rewards', function (Blueprint $table) {
            $table->renameColumn('label', 'name');
            $table->text('description');
        });
        Schema::table('user_scores', function (Blueprint $table) {
           $table->string('game', 16);
           $table->dropForeignIdFor(Game::class);
        });
    }
};
