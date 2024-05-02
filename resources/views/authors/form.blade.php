<!-- not used -->
<div class="container">
    <h1>Add a New Author</h1>
    <form action="/authors" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Author Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>