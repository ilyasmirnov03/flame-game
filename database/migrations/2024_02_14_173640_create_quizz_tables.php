<?php

use App\Models\Language;
use App\Models\QuizQuestion;
use App\Models\QuizAnswer;
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
        Schema::create('og_quiz_questions', function (Blueprint $table) {
            $table->id();
            $table->string('label', 16)->nullable();
        });

        Schema::create('og_quiz_answers', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_right');
            $table->foreignIdFor(QuizQuestion::class, 'quiz_question_id');
        });

        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('code', 2);
        });

        Schema::create('og_quiz_translations', function (Blueprint $table) {
            $table->id();
            $table->text('question');
            $table->foreignIdFor(QuizQuestion::class, 'quiz_question_id');
            $table->foreignIdFor(Language::class);
        });

        Schema::create('og_quiz_answers_translations', function (Blueprint $table) {
            $table->id();
            $table->text('answer');
            $table->foreignIdFor(QuizAnswer::class, 'quiz_answer_id');
            $table->foreignIdFor(Language::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('og_quiz_translations');
        Schema::dropIfExists('og_quiz_answers_translations');
        Schema::dropIfExists('og_quiz_answers');
        Schema::dropIfExists('og_quiz');
        Schema::dropIfExists('languages');
    }
};
