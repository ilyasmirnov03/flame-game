<?php

use App\Enums\RewardPlayerPosition;
use App\Models\Reward;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Rewards to populate the database with
     * @var array|array[]
     */
    private array $rewards = [
        [
            'score_needed' => 1000,
            'icon' => 'icon',
            'on_player_image' => 'on_player_image',
            'position' => RewardPlayerPosition::HEAD
        ]
    ];

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
            });
        }

        if (DB::table('rewards')->count() == 0) {
            DB::table('rewards')->insert($this->rewards);
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
