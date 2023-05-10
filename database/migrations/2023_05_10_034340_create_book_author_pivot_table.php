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
        Schema::create('book_author_pivot', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(
                \App\Models\Book::class,
                'book_id'
            );
            $table->foreignIdFor(
                \App\Models\Author::class,
                'author_id'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_author_pivot');
    }
};
