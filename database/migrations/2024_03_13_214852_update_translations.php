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
        Schema::table('og_fun_fact_translations', function(Blueprint $table) {
            $table->text('fact')->nullable()->change();
        });
        Schema::table('og_quiz_answers_translations', function(Blueprint $table) {
            $table->text('answer')->nullable()->change();
        });
        Schema::table('og_quiz_translations', function(Blueprint $table) {
            $table->text('question')->nullable()->change();
        });
        Schema::table('game_translations', function(Blueprint $table) {
            $table->text('title')->nullable()->change();
            $table->text('description')->nullable()->change();
        });
        Schema::table('reward_translations', function(Blueprint $table) {
            $table->text('title')->nullable()->change();
            $table->text('description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('og_fun_fact_translations', function(Blueprint $table) {
            $table->text('fact')->nullable(false)->change();
        });
        Schema::table('og_quiz_answers_translations', function(Blueprint $table) {
            $table->text('answer')->nullable(false)->change();
        });
        Schema::table('og_quiz_translations', function(Blueprint $table) {
            $table->text('question')->nullable(false)->change();
        });
        Schema::table('game_translations', function(Blueprint $table) {
            $table->text('title')->nullable(false)->change();
            $table->text('description')->nullable(false)->change();
        });
        Schema::table('reward_translations', function(Blueprint $table) {
            $table->text('title')->nullable(false)->change();
            $table->text('description')->nullable(false)->change();
        });
    }
};
