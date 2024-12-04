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
        // Include a new column price.
        Schema::table('courses', function (Blueprint $table) {
            $table->float('price')->after('description')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // For rollback if necessary.
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('price');
        });
    }
};
