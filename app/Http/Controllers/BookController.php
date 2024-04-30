<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Book; // import book model

class BookController extends Controller
{
    // implement routes

    // list all books
    public function index()
    {
        $books = Book::all(); //retrieve all of the records from the model's associated database table

        return view('books.view', ['books' => $books]); // return view from controller with global view() helper
    }

    // form to create new book
    public function create()
    {
        return view('books.form'); // return view to show form
    }
    
    // store new book
    public function store(Request $request)
    {
        // apply validation rules
        // could use $rules array to apply rules conditionally
        // ex. $request->validate($rules)
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'year' => 'required|integer',
            'genre' => 'required',
        ]);

        // create new book object and set columns
        $book = new Book();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->year = $request->year;
        $book->genre = $request->genre;
        $book->save();
        // or Book::create([...]) not sure what the difference is

        return redirect('/books');
    }

}
