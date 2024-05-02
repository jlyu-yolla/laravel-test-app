<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- added bootstrap -->

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Books List</h1>
    <a href="/authors" class="btn btn-sm">View Authors</a> <!-- Button to navigate to authors page -->
</div>

<ul class="list-group mb-3">
    <a href="/books/create" class="btn btn-primary mb-3">Add New Book</a> <!-- link to the create page -->
    @foreach ($books as $book)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
                {{ $book->title }} - {{ $book->author ? $book->author->name : 'Not Set' }} - {{ $book->year }} - {{ $book->genre }}
            </div>
            <div class="dropdown">
                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton-{{ $book->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                    ...
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton-{{ $book->id }}">
                    <li><a class="dropdown-item" href="/books/{{ $book->id }}/edit">Edit</a></li>
                    <li> <!-- Delete does not have its own page so directly route-->
                        <form action="/books/{{ $book->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item">Delete</button>
                        </form>
                    </li>
                </ul>
            </div>
        </li>
    @endforeach
</ul>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
