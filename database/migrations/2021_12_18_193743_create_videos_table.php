<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{

    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('title');
            $table->string('description');
            $table->string('thumbnail');
            $table->dateTime('published_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
}
