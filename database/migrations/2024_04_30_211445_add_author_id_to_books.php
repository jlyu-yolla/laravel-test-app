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
        // add foreign key column for books to store author_id
        Schema::table('books', function (Blueprint $table) {
            //remove the author column, using author table now and referencing author_id
            $table->dropColumn('author');

            // constrained() infers the id is from a foreign column called('author_id') 
            // like REFERENCES authors(id) in postgres
            // onDelete chains the foreign key to be deleted in teh referenced parent table
            $table->foreignId('author_id')->constrained()->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // recreate the author column
            $table->string('author');

            $table->dropForeign(['author_id']); // drop foreign key constraint
            $table->dropColumn('author_id'); // drop foreign key column
        });
    }
};
