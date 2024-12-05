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
        // Include a new column order_classe.
        Schema::table('classes', function (Blueprint $table) {
            $table->integer('order_classe')->after('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // For rollback if necessary.
        Schema::table('classes', function (Blueprint $table) {
            $table->dropColumn('order_classe');
        });
    }
};
