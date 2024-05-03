<?php

// repository pattern 
// make the model store only the schema 
// abstract fetching to repository 

// service pattern
// abstract business logic to schema to handle all operations


namespace App\Services;

use App\Models\Book;
use App\Models\Author;

class BookService
{
    protected $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    public function getAllBooks() //from to 
    {
        return Book::with('author')->get();
    }

    public function findBook($id)
    {
        return Book::with('author')->findOrFail($id);
    }

    public function createBook($data)
    {
        // $author = Author::firstOrCreate(['name' => $data['author']]);
        //use author service for any author queries or writes
        $author = $this->authorService->createAuthor(['name' => $data['author']]);

        $data['author_id'] = $author->id;
        return Book::create($data);
    }

    public function updateBook($id, $data)
    {
        $book = $this->findBook($id); 
        $author = Author::firstOrCreate(['name' => $data['author']]); // would you invoke author service here or handle it directly
        $data['author_id'] = $author->id;
        $book->update($data);
        return $book;
    }

    public function deleteBook($id)
    {
        $book = $this->findBook($id);
        return $book->delete();
    }
}
