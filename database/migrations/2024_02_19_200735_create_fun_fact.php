<?php

use App\Models\FunFact;
use App\Models\Language;
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
        Schema::create('og_fun_facts', function (Blueprint $table) {
            $table->id();
            $table->string('label', 16)->nullable();
        });

        Schema::create('og_fun_fact_translations', function (Blueprint $table) {
            $table->id();
            $table->text('fact');
            $table->foreignIdFor(FunFact::class, 'fun_fact_id');
            $table->foreignIdFor(Language::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('og_fun_fact_translations');
        Schema::dropIfExists('og_fun_facts');
    }
};
