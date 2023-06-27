<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->comment('Title');
            $table->string('original_title', 255)->nullable()->comment('Original title');
            $table->string('subtitle', 255)->nullable()->comment('Subtitle');
            $table->string('original_subtitle', 255)->nullable()->comment('Original subtitle');
            $table->integer('publication_year')->nullable()->comment('Publication year');
            $table->integer('number_pages')->nullable()->comment('Number of pages');
            $table->integer('edition_number')->nullable()->comment('Edition number');
            $table->string('synopsis', 5000)->nullable()->comment('Book synopsis');
            $table->integer('height')->nullable()->comment('Height (millimeters)');
            $table->integer('width')->nullable()->comment('Width (millimeters)');
            $table->integer('thickness')->nullable()->comment('Thickness (millimeters)');
            $table->integer('weight')->nullable()->comment('Weight (grams)');
            $table->timestamps();
            $table->softDeletes();
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
