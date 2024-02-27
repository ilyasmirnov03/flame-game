<?php

use App\Models\Reward;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('rewards')) {
            Schema::create('rewards', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->mediumInteger('score_needed');
                $table->string('icon');
                $table->string('on_player_image');
                $table->tinyInteger('position');
            });
        }

        if (!Schema::hasTable('user_rewards')) {
            Schema::create('user_rewards', function (Blueprint $table) {
                $table->id();
                $table->foreignIdFor(User::class);
                $table->foreignIdFor(Reward::class);
                $table->boolean('selected')->default(true);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_rewards');
        Schema::dropIfExists('rewards');
    }
};
