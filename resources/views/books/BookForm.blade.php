<form method = "post" action = "/books">
    @csrf <!-- need to add this to any write methods 
        the CSRF protection middleware can validate the request -->

    <label for = "title">Title:</label>
    <input type = "text" id = "title" name = "title" required><br>
    <label for = "author">Author:</label>
    <input type = "text" id = "author" name = "author" required><br>
    <label for = "year">Year:</label>
    <input type = "number" id = "year" name = "year" required><br>
    <label for = "genre">Genre:</label>
    <input type = "text" id = "genre" name = "genre" required><br>
    <button type = "submit">Add Book</button>
</form>
