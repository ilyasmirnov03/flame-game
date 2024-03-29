<?php

use App\Models\Group;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('user_scores')) {
            Schema::create('user_scores', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->integer('score');
                $table->foreignIdFor(User::class);
                $table->foreignIdFor(Group::class)->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_scores');
    }
};
