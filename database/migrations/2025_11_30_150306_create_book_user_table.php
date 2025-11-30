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
        Schema::create('book_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('book_id')->index('book_user_book_id_foreign');
            $table->date('add_date')->nullable();
            $table->date('read_date')->nullable();
            $table->text('comment')->nullable();
            $table->unsignedTinyInteger('rating')->nullable();
            $table->enum('state', ['favorite', 'borrowed', 'sold', 'lost'])->nullable();
            $table->boolean('property')->unsigned();
            $table->timestamps();

            $table->unique(['user_id', 'book_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_user');
    }
};
