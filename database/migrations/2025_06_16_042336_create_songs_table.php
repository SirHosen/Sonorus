<?php
// database/migrations/xxxx_xx_xx_create_songs_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('composer_id')->constrained()->onDelete('cascade');
            $table->string('year')->nullable();
            $table->string('duration')->nullable();
            $table->text('description')->nullable();
            $table->string('audio_file');
            $table->string('cover_image')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('songs');
    }
};
