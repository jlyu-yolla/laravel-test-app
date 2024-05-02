<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Author; // import author model

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();
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

        $author = new Author();
        $author->name = $request->name;
        $author->save();

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
        
        $author->name = $request->name;
        $author->save();
    
        return response()->json(['success' => true]); // response for front end
    }
    

    public function destroy(Author $author)
    {
        //find author
        $author->delete();
        return redirect('/authors');
    }
}
