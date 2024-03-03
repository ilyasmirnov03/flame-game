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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['member', 'redactor', 'administrator'])->default('member');
        });

        Schema::table('group_members', function(Blueprint $table) {
            $table->enum('role', ['member', 'owner'])->default('member');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role']);
        });

        Schema::table('group_members', function(Blueprint $table) {
            $table->dropColumn(['role']);
        });
    }
};
