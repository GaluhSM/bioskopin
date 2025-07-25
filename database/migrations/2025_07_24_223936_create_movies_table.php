<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('synopsis');
            $table->string('poster_url')->nullable();
            $table->integer('duration_minutes');
            $table->date('release_date');
            $table->string('audience_rating', 10);
            $table->string('producer')->nullable();
            $table->string('publisher')->nullable();
            $table->boolean('is_trending')->default(false);
            $table->decimal('rating', 3, 1)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};