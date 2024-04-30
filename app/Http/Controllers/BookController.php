<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Book; // import book model
use App\Models\Author; // import author model

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

        //firstOrCreate matches record found returns the record, if not record is found, creates new record in database
        //fristOrNew matches record found and return the reocrd, if not found, returns new instance but does not presist in database
        // must call save() explicity to save to database
        // check author table if name already exists 
        $author = Author::firstOrCreate([
            'name' => $request->author
        ]);
        // create new book object and set columns
        $book = new Book();
        $book->title = $request->title;
        // $book->author = $request->author; // not sure if this is redundant now that we are storing author_id in its own table 
        $book->author_id = $author->id; // use the found or created author id
        $book->year = $request->year;
        $book->genre = $request->genre;
        $book->save();
        // or Book::create([...]) not sure what the difference is

        return redirect('/books');
    }

}
