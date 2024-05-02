<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // make author_id nullable
            $table->unsignedBigInteger('author_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // redo changes from last migration
            $table->unsignedBigInteger('author_id')->nullable(false)->change();
        });
    }
};
