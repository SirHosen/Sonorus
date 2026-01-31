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
        // Change birth_year and death_year to integer in composers table
        Schema::table('composers', function (Blueprint $table) {
            $table->integer('birth_year')->nullable()->change();
            $table->integer('death_year')->nullable()->change();
        });

        // Change year to integer in songs table
        Schema::table('songs', function (Blueprint $table) {
            $table->integer('year')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert birth_year and death_year to string in composers table
        Schema::table('composers', function (Blueprint $table) {
            $table->string('birth_year')->nullable()->change();
            $table->string('death_year')->nullable()->change();
        });

        // Revert year to string in songs table
        Schema::table('songs', function (Blueprint $table) {
            $table->string('year')->nullable()->change();
        });
    }
};
