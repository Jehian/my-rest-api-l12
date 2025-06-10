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
        $table->id(); // INT auto_increment primary key
        $table->text('title');
        $table->string('author', 100)->nullable();
        $table->string('publisher', 100)->nullable();
        $table->string('publication_year', 4)->nullable();
        $table->text('cover')->nullable();
        $table->text('description')->nullable();
        $table->double('price')->nullable();

        $table->timestamp('created_at')->useCurrent(); // default now()
        $table->integer('created_by')->nullable();
        $table->timestamp('updated_at')->nullable();
        $table->integer('updated_by')->nullable();
        $table->timestamp('deleted_at')->nullable();
        $table->integer('deleted_by')->nullable();
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
