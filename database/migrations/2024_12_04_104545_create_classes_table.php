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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable(false);
            $table->text('description')->nullable();
            $table->integer('status')->nullable(false)->default(1);
            $table->text('image')->nullable();
            $table->foreignId('course_id')->constrained('courses'); // Table relation.

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations (rollback).
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
