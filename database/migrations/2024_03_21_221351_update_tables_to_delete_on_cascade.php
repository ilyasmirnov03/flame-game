<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Delete scores, rewards and group memberships of user on its deletion
        Schema::table('user_scores', function (Blueprint $table) {
            $table->foreignId('user_id')->change()->constrained()->cascadeOnDelete();
        });

        Schema::table('user_rewards', function (Blueprint $table) {
            $table->foreignId('user_id')->change()->constrained()->cascadeOnDelete();
        });

        Schema::table('group_members', function (Blueprint $table) {
            $table->foreignId('group_id')->change()->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->change()->constrained()->cascadeOnDelete();
        });

        // Delete translations on language delete
        Schema::table('game_translations', function (Blueprint $table) {
            $table->foreignId('language_id')->change()->constrained()->cascadeOnDelete();
        });

        Schema::table('og_fun_fact_translations', function (Blueprint $table) {
            $table->foreignId('language_id')->change()->constrained()->cascadeOnDelete();
        });

        Schema::table('og_quiz_answers_translations', function (Blueprint $table) {
            $table->foreignId('language_id')->change()->constrained()->cascadeOnDelete();
            $table->foreign('quiz_answer_id')->references('id')->on('og_quiz_answers')
                ->cascadeOnDelete();
        });

        Schema::table('og_quiz_translations', function (Blueprint $table) {
            $table->foreignId('language_id')->change()->constrained()->cascadeOnDelete();
        });

        Schema::table('reward_translations', function (Blueprint $table) {
            $table->foreignId('language_id')->change()->constrained()->cascadeOnDelete();
        });

        // Remove quiz answers on quiz deletion
        Schema::table('og_quiz_answers', function (Blueprint $table) {
            $table->foreign('quiz_question_id')->references('id')->on('og_quiz_questions')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
