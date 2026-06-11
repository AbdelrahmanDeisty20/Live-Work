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
        // Drop contents table first because of foreign key constraint
        Schema::dropIfExists('contents');

        // Rename title column to name in skills table
        Schema::table('skills', function (Blueprint $table) {
            $table->renameColumn('title', 'name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('skills', function (Blueprint $table) {
            $table->renameColumn('name', 'title');
        });

        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('value');
            $table->integer('percentage');
            $table->foreignId('skill_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }
};
