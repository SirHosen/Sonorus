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
        // Add indexes to composers table
        Schema::table('composers', function (Blueprint $table) {
            $table->index('name');
            $table->index('country');
        });

        // Add indexes to songs table
        Schema::table('songs', function (Blueprint $table) {
            $table->index('title');
            $table->index('composer_id');
        });

        // Add indexes to playlists table
        Schema::table('playlists', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('name');
        });

        // Add unique constraint and indexes to playlist_song table
        Schema::table('playlist_song', function (Blueprint $table) {
            $table->unique(['playlist_id', 'song_id'], 'playlist_song_unique');
            $table->index('playlist_id');
            $table->index('song_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop indexes from composers table
        Schema::table('composers', function (Blueprint $table) {
            $table->dropIndex(['name']);
            $table->dropIndex(['country']);
        });

        // Drop indexes from songs table
        Schema::table('songs', function (Blueprint $table) {
            $table->dropIndex(['title']);
            $table->dropIndex(['composer_id']);
        });

        // Drop indexes from playlists table
        Schema::table('playlists', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['name']);
        });

        // Drop unique constraint and indexes from playlist_song table
        Schema::table('playlist_song', function (Blueprint $table) {
            $table->dropUnique('playlist_song_unique');
            $table->dropIndex(['playlist_id']);
            $table->dropIndex(['song_id']);
        });
    }
};
