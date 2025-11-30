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
        Schema::table('book_user', function (Blueprint $table) {
            $table->foreign(['book_id'])->references(['id'])->on('books')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('book_user', function (Blueprint $table) {
            $table->dropForeign('book_user_book_id_foreign');
            $table->dropForeign('book_user_user_id_foreign');
        });
    }
};
