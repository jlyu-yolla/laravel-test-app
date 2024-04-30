<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    /* php artisan make:migration add_timestamps_to_books_table --table=books
    // migrations is version control for changes in the database (eg. updating columns)
    // you're able to roll back migrations with php artisan migrate:rollback
    // run migration php artisan migrate
    NOTE: php artisan:refresh/fresh will drop all tables because it will call down() on all migrations and apply migrations again
          creation migrations will have drop if exists on their tables <- probably should not use refresh/fresh 
    */

    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->timestamps(); // Adds created_at and updated_at columns to our book schema
        });
    }

    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['created_at', 'updated_at']); // removes the columns we added if rolled back
        });
    }
};
