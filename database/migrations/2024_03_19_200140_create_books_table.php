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
        Schema::create('books', function (Blueprint $table) {
            $table->id();

            $table->string('name')->comment('Name of the book');
            $table->string('srn')->comment('Serial number of the book');
            $table->integer('pages_count');
            $table->integer('publisher_id');
		    $table->integer('author_id');
		    $table->integer('category_id');
            $table->dateTime('published_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
