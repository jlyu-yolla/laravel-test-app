<ul>
    @foreach ($books as $book)
        <li>{{ $book->title }} by {{ $book->author->name }} ({{ $book->year }} - {{ $book->genre }})</li>
    @endforeach
</ul>
