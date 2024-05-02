<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Book; // import book model
use App\Models\Author; // import author model

use App\Services\BookService;
use App\Services\AuthorService;

class BookController extends Controller
{
    protected $bookService;
    protected $authorService;

    public function __construct(BookService $bookService, AuthorService $authorService) {
        $this->bookService = $bookService;
        $this->authorService = $authorService;
    }
    // implement routes

    // list all books
    public function index()
    {
        // $books = Book::all(); //retrieve all of the records from the model's associated database table

        $books = $this->bookService->getAllBooks(); //should ideally be done with repository layer
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
        // $author = Author::firstOrCreate([
        //     'name' => $request->author
        // ]);
        // // create new book object and set columns
        // $book = new Book();
        // $book->title = $request->title;
        // // $book->author = $request->author; // not sure if this is redundant now that we are storing author_id in its own table 
        // $book->author_id = $author->id; // use the found or created author id
        // $book->year = $request->year;
        // $book->genre = $request->genre;
        // $book->save();
        // or Book::create([...]) not sure what the difference is

        //with service layer
        $this->bookService->createBook($request->all());

        return redirect('/books');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $authors = Author::all();

        $book = $this->bookService->findBook($id);
        $authors = $this->authorService->getAllAuthors();

        return view('books.edit', ['book' => $book, 'authors' => $authors]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'year' => 'required|integer',
            'genre' => 'required',
        ]);

        //if new author is inputted as edit
        // $author = Author::firstOrCreate(['name' => $request->author]);

        // $book = Book::findOrFail($id);
        // $book->update([
        //     'title' => $request->title,
        //     'author_id' => $author->id,
        //     'year' => $request->year,
        //     'genre' => $request->genre,
        // ]);
        
        $this->bookService->updateBook($id, $request->all());
        return redirect('/books');
    }

    // delete book
    public function destroy($id)
    {
        // find book 
        // $book = Book::findOrFail($id);
        // $book->delete();

        $this->bookService->deleteBook($id);

        return redirect('/books');
    }

}
