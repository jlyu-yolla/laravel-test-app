<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use \App\Models\Book;
use SplFileObject; // 

class ExportBooksToCSV extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:books';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export books to CSV file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //fetch books
        $books = Book::all();

        // Define the CSV file path
        $filePath = storage_path('logs/books.csv');

        // create/open new file for 
        $file = new SplFileObject($filePath, 'w');

        // define header row
        $file->fwrite("Title,Author,Year,Genre,Created At,Updated At\n");

        // write book column data to files
        foreach ($books as $book) {
            $authorName = $book->author ? $book->author->name : 'Not Set or NULL';
            $file->fputcsv([$book->title, $authorName, $book->year, $book->genre, $book->created_at, $book->updated_at]);
        }

        $this->info('Books exported to CSV successfully.'); // output to console once write it complete
    }
}
