<?php


namespace App\Services;

use App\Models\Book;
use App\Models\Author;

class AuthorService
{
    public function getAllAuthors()
    {
        return Author::all();
    }

    public function createAuthor($data)
    {
        return Author::create($data);
    }

    public function updateAuthor(Author $author, $data)
    {
        $author->update($data);
        return $author;
    }

    public function deleteAuthor(Author $author)
    {
        $author->delete();
    }

}