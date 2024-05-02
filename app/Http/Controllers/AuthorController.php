<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Author; // import author model
use App\Services\AuthorService;
class AuthorController extends Controller
{
    protected $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    public function index()
    {
        //$authors = Author::all();
        $authors = $this->authorService->getAllAuthors();
        return view('authors.view', ['authors' => $authors]);
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        // $author = new Author();
        // $author->name = $request->name;
        // $author->save();

        $this->authorService->createAuthor($request->all());
        return redirect('/authors');
    }

    public function edit(Author $author)
    {
        return view('authors.edit', ['author' => $author]);
    }

    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name' => 'required|string',
        ]);
        
        // $author->name = $request->name;
        // $author->save();
        
        $this->authorService->updateAuthor($author, $request->all());
        return response()->json(['success' => true]); // response for front end
    }
    

    public function destroy(Author $author)
    {
        //find author
        // $author->delete();
        $this->authorService->deleteAuthor($author);
        return redirect('/authors');
    }
}
