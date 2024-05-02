<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">


<h1>Edit Book</h1>

<form action = "/books/{{ $book->id }}"  method="POST">
    @csrf
    @method('PUT')

    <!-- autofill fields with original $book values -->
    <div>
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="{{ $book->title }}">
    </div>

    <div>
        <label for= "author">Author:</label>
        <input type="text" id="author" name="author" value="{{ $book->author ? $book->author->name : '' }}" required>
    </div>

    <div>
        <label for="year">Year:</label>
        <input type="text" id="year" name="year" value="{{ $book->year }}">
    </div>

    <div>
        <label for="genre">Genre:</label>
        <input type="text" id="genre" name="genre" value="{{ $book->genre }}">
    </div>

    <button type="submit">Update Book</button>
</form>
