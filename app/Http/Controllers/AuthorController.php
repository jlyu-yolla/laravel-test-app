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
        return view('authors.index', ['authors' => $authors]);
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

        return redirect()->route('authors.index');
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
        
        $author->update([
            'name' => $request->name,
        ]);
        
        return redirect()->route('authors.index');
    }

    public function destroy(Author $author)
    {
        //find author
        $author->delete();
        return redirect()->route('authors.index');
    }
}
