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
        Schema::create('songs', function (Blueprint $table) {
            $table->id('SongID');
            $table->string('SongName')->nullable();
            $table->string('SongImage')->nullable();
            $table->string('SongAudio')->nullable();
            $table->text('Lyrics')->nullable();
            $table->string('GenreID')->nullable();
            $table->string('ArtistID')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('songs');
    }
};
