<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
{{-- <h1>Authors List</h1> --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Authors</h1>
        <a href="/books" class="btn btn-sm">View Authors</a> <!-- Button to navigate to authors page -->
    </div>
    <form action="/authors" method="POST">
        @csrf
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Enter author name" name="name" required>
            <button class="btn btn-outline-secondary" type="submit">Add Author</button>
        </div>
    </form>

    <ul class="list-group mb-3">
        @foreach ($authors as $author)
        <li class="list-group-item">
            <div class="d-flex justify-content-between align-items-center">
                <div id="author-name-{{ $author->id }}" class="d-flex align-items-center">
                    <strong>{{ $author->name }}</strong>
                    <input type="text" id="input-author-name-{{ $author->id }}" class="form-control d-none" value="{{ $author->name }}">
                    <button id="save-button-{{ $author->id }}" onclick="saveAuthor({{ $author->id }})" class="btn d-none">Save</button>
                    <button id="cancel-button-{{ $author->id }}" onclick="cancelEdit({{ $author->id }})" class="btn d-none">Cancel</button>
                </div>                           
                <div class="dropdown">
                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton-{{ $author->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                        Actions
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton-{{ $author->id }}">
                        <li><a class="dropdown-item" href="javascript:void(0);" onclick="editAuthor({{ $author->id }})">Edit</a></li>
                        <li>
                            <form action="/authors/{{ $author->id }}" method="POST"> <!-- use destroy method -->
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item">Delete</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <ul class="list-group mt-2">
                @foreach ($author->books as $book)
                <li class="list-group-item">{{ $book->title }}</li>
                @endforeach
            </ul>
        </li>
        @endforeach
    </ul>
</div>





<script> // allow for inline editing so we're not directing to form page
        // edit is is handled with a fetch to with javascript
    function editAuthor(id) {
        // grab elements
        var displayDiv = document.getElementById('author-name-' + id);
        var inputField = document.getElementById('input-author-name-' + id);
        var saveButton = document.querySelector('button[onclick="saveAuthor('+id+')"]');
        var cancelButton = document.querySelector('button[onclick="cancelEdit('+id+')"]');

        displayDiv.querySelector('strong').classList.add('d-none');
        inputField.classList.remove('d-none');
        saveButton.classList.remove('d-none');
        cancelButton.classList.remove('d-none'); // Show the cancel button
    }

    function saveAuthor(id) {
        var inputField = document.getElementById('input-author-name-' + id);
        var newName = inputField.value;

        fetch('/authors/' + id, {
            method: 'POST', // Should be PUT but only post works??
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ name: newName, _method: 'PUT' }) // Clean data
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) { // once edit has been saved, hide text box and save/cancel button
                var displayDiv = document.getElementById('author-name-' + id);
                displayDiv.querySelector('strong').innerText = newName;
                displayDiv.querySelector('strong').classList.remove('d-none');
                inputField.classList.add('d-none');
                document.getElementById('save-button-' + id).classList.add('d-none');
                document.getElementById('cancel-button-' + id).classList.add('d-none');
            } else {
                alert('Error updating author.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to update author name.');
        });
    }



    function cancelEdit(id) {
        var displayDiv = document.getElementById('author-name-' + id);
        var inputField = document.getElementById('input-author-name-' + id);

        inputField.classList.add('d-none'); // hide when not needed
        displayDiv.querySelector('strong').classList.remove('d-none');
        document.querySelector('button[onclick="saveAuthor('+id+')"]').classList.add('d-none');
        document.querySelector('button[onclick="cancelEdit('+id+')"]').classList.add('d-none');
    }

</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
