<?php

use App\Models\Language;
use App\Models\Quizz;
use App\Models\QuizzAnswer;
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
        Schema::create('og_quizz', function (Blueprint $table) {
            $table->id();
        });

        Schema::create('og_quizz_answers', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_right');
            $table->foreignIdFor(Quizz::class, 'quizz_id');
        });

        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('code', 2);
        });

        Schema::create('og_quizz_translations', function (Blueprint $table) {
            $table->id();
            $table->text('question');
            $table->foreignIdFor(Quizz::class, 'quizz_id');
            $table->foreignIdFor(Language::class);
        });

        Schema::create('og_quizz_answers_translations', function (Blueprint $table) {
            $table->id();
            $table->text('answer');
            $table->foreignIdFor(QuizzAnswer::class, 'quizz_answer_id');
            $table->foreignIdFor(Language::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('og_quizz_translations');
        Schema::dropIfExists('og_quizz_answers_translations');
        Schema::dropIfExists('og_quizz_answers');
        Schema::dropIfExists('og_quizz');
        Schema::dropIfExists('languages');
    }
};
