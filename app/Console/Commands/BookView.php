<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use \App\Models\Book;

class BookView extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bookview';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Output books to console';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Fetch all books
        $books = Book::all();
        // Output each book's details

        foreach ($books as $book) {
            $authorName = $book->author->name; // for some reason can't do $book->author->name
            $this->line("$book->title - $authorName - $book->year - $book->genre");
        }
    }
}
