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
        // Add soft deletes to composers table
        Schema::table('composers', function (Blueprint $table) {
            $table->softDeletes();
        });

        // Add soft deletes to songs table
        Schema::table('songs', function (Blueprint $table) {
            $table->softDeletes();
        });

        // Add soft deletes to playlists table
        Schema::table('playlists', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop soft deletes from composers table
        Schema::table('composers', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        // Drop soft deletes from songs table
        Schema::table('songs', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        // Drop soft deletes from playlists table
        Schema::table('playlists', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
