<x-app-layout>
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white min-h-screen p-4">
            <h2 class="text-lg font-bold mb-4">Library Management</h2>
            @include('components.left-nav')
        </aside>

        <!-- Main Content -->
        <main class="flex-1 bg-gray-100 p-6 custom-flow">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Books</li>
                    </ol>
                </nav>

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="top">
                    <div class="card shadow-sm rounded">
                        <div class="card-header bg-custom text-white p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Books</h5>
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add-genre">Add Genre</button>

                                    <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add-author">Add Author</button>

                                    <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add-book">Add Book</button>

                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- You can add content for the books list here -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Author</th>
                                                <th>Genre</th>
                                                <th class="text-center">Publication Year</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($books as $book)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{$book->title ?? 'N/A'}}</td>
                                                <td>
                                                    @foreach ($book->authors as $author)
                                                    {{ $author->firstname }} {{ $author->lastname }}<br>
                                                    @endforeach
                                                </td>
                                                <td>{{$book->genre->genre_name ?? ''}}</td>
                                                <td class="text-center">{{$book->publication_year ?? ''}}</td>
                                                <td class="text-center d-flex justify-content-center gap-3">
                                                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-sm btn-info me-2" title="View">
                                                        <i class="fas fa-eye"></i>View
                                                    </a>
                                                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash-alt"></i> Delete
                                                        </button>
                                                    </form>

                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="6" class='text-center p-5'>No Book Available in the system</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                        <div class="d-flex justify-content-center mt-4">
                                            {{ $books->links() }}
                                        </div>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- MODALS -->

    <!-- ADD BOOK MODAL -->
    <div class="modal fade" id="add-book" tabindex="-1" aria-labelledby="add-bookLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-bookLabel">Add New Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="add-book-form" action="{{route('books.store')}}" enctype="multipart/form-data" method="post" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                            <div class="invalid-feedback">Please enter the book title.</div>
                        </div>
                        <div class="mb-3">
                            <label for="author" class="form-label">Author</label>
                            <select class="form-select" id="author" name="author_id" required>
                                <option value="" disabled selected>Select an author</option>
                                @foreach ($authors as $author )
                                <option class="text-black" value="{{ $author->id }}">{{ $author->firstname }} {{$author->lastname}}</option>

                                @endforeach
                            </select>
                            <div class="invalid-feedback">Please select an author.</div>
                        </div>

                        <div class="mb-3">
                            <label for="genre" class="form-label">Genre</label>
                            <select class="form-select" id="genre" name="genre_id" required>
                                <option value="" disabled selected>Select a genre</option>
                                @foreach ($genres as $genre)
                                <option class="text-black" value="{{ $genre->id }}">{{ $genre->genre_name }}</option>
                                @endforeach

                            </select>
                            <div class="invalid-feedback">Please select a genre.</div>
                        </div>


                        <div class="mb-3">
                            <label for="publication_year" class="form-label">Publication Year</label>
                            <input type="number" class="form-control" id="publication_year" name="publication_year" min="1900" max="2025" required>
                            <div class="invalid-feedback">Please enter a valid publication year between 1900 and 2025.</div>
                        </div>
                        <div class="mb-3">
                            <label for="book_file" class="form-label">Upload Book File</label>
                            <input type="file" class="form-control" id="book_file" name="book_file" accept=".pdf" required>
                            <div class="invalid-feedback">Please upload a valid book file (PDF, EPUB, DOCX).</div>
                        </div>

                        <button type="submit" class="btn btn-info" id="submit-book">Save Book</button>

                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ADD  AUTHOR MODAL -->
    <div class="modal fade" id="add-author" tabindex="-1" aria-labelledby="add-bookLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-bookLabel">Add New Author</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="add-book-form" action="{{route('author.store')}}" method="get" novalidate>
                        <div class="mb-3">
                            <label for="firstname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" required>
                            <div class="invalid-feedback">Please enter the first name .</div>
                        </div>
                        <div class="mb-3">
                            <label for="lastname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" required>
                            <div class="invalid-feedback">Please enter the last name</div>
                        </div>

                        <button type="submit" class="btn btn-info" id="submit-book">Save Author</button>

                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ADD GENRE MODAL -->
    <div class="modal fade" id="add-genre" tabindex="-1" aria-labelledby="add-bookLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-bookLabel">Add New Genre</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="add-book-form" method="get" action="{{ route('genre.store')}}" novalidate>
                        <div class="mb-3">
                            <label for="genre" class="form-label">Genre Name</label>
                            <input type="text" class="form-control" id="genre" name="genre" required>
                            <div class="invalid-feedback">Please enter the genre name</div>
                        </div>
                        <button type="submit" class="btn btn-info" id="submit-book">Save Genre</button>

                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#submit-book").on('click', function(e) {
                e.preventDefault();

                const form = document.getElementById('add-book-form');

                if (!form.checkValidity()) {
                    $('#add-book-form').addClass('was-validated');
                } else {
                    alert('Form is valid, submitting data...');
                }
            });

            $(".alert").slideUp();
        });
    </script>
</x-app-layout>