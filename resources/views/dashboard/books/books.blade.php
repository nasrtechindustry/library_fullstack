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
                        <li class="breadcrumb-item"><a href="#">Books</a></li>
                        <li class="breadcrumb-item active" aria-current="page">view</li>
                    </ol>
                </nav>
                <div class="top">
                    <div class="card shadow-sm rounded">
                        <div class="card-header bg-custom text-white p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Books</h5>
                                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add-book">Add Book</button>
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
                                                <th>Publication Year</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Example rows; Replace these with dynamic content -->
                                            <tr>
                                                <td>1</td>
                                                <td>The Great Gatsby</td>
                                                <td>F. Scott Fitzgerald</td>
                                                <td>Fiction</td>
                                                <td>1925</td>
                                                <td>
                                                    <button class="btn btn-sm btn-info me-2" title="View">
                                                        <i class="fas fa-eye"></i> <!-- View Icon -->
                                                    </button>
                                                    <button class="btn btn-sm btn-primary me-2" title="Edit">
                                                        <i class="fas fa-edit"></i> <!-- Edit Icon -->
                                                    </button>
                                                    <button class="btn btn-sm btn-danger" title="Delete">
                                                        <i class="fas fa-trash-alt"></i> <!-- Delete Icon -->
                                                    </button>
                                                </td>


                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>To Kill a Mockingbird</td>
                                                <td>Harper Lee</td>
                                                <td>Drama</td>
                                                <td>1960</td>
                                                <td>
                                                    <button class="btn btn-sm btn-info me-2" title="View">
                                                        <i class="fas fa-eye"></i> <!-- View Icon -->
                                                    </button>
                                                    <button class="btn btn-sm btn-primary me-2" title="Edit">
                                                        <i class="fas fa-edit"></i> <!-- Edit Icon -->
                                                    </button>
                                                    <button class="btn btn-sm btn-danger" title="Delete">
                                                        <i class="fas fa-trash-alt"></i> <!-- Delete Icon -->
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>1984</td>
                                                <td>George Orwell</td>
                                                <td>Dystopian</td>
                                                <td>1949</td>
                                               <td>
                                                    <button class="btn btn-sm btn-info me-2" title="View">
                                                        <i class="fas fa-eye"></i> <!-- View Icon -->
                                                    </button>
                                                    <button class="btn btn-sm btn-primary me-2" title="Edit">
                                                        <i class="fas fa-edit"></i> <!-- Edit Icon -->
                                                    </button>
                                                    <button class="btn btn-sm btn-danger" title="Delete">
                                                        <i class="fas fa-trash-alt"></i> <!-- Delete Icon -->
                                                    </button>
                                                </td>
                                            </tr>
                                            <!-- Add more rows dynamically -->
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                            <!-- <p class="text-muted">No books added yet. Click on "Add Book" to get started.</p> -->
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>




    <!-- modal add book action -->
    <!-- Button to trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-book">
        Add New Book
    </button>

    <!-- Modal -->
    <div class="modal fade" id="add-book" tabindex="-1" aria-labelledby="add-bookLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-bookLabel">Add New Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="add-book-form" novalidate>
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                            <div class="invalid-feedback">Please enter the book title.</div>
                        </div>
                        <div class="mb-3">
                            <label for="author" class="form-label">Author</label>
                            <input type="text" class="form-control" id="author" name="author" required>
                            <div class="invalid-feedback">Please enter the author's name.</div>
                        </div>
                        <div class="mb-3">
                            <label for="genre" class="form-label">Genre</label>
                            <input type="text" class="form-control" id="genre" name="genre" required>
                            <div class="invalid-feedback">Please enter the genre.</div>
                        </div>
                        <div class="mb-3">
                            <label for="publication_year" class="form-label">Publication Year</label>
                            <input type="number" class="form-control" id="publication_year" name="publication_year" min="1900" max="2025" required>
                            <div class="invalid-feedback">Please enter a valid publication year between 1900 and 2025.</div>
                        </div>
                        <div class="mb-3">
                            <label for="book-file" class="form-label">Upload Book File</label>
                            <input type="file" class="form-control" id="book-file" name="book_file" accept=".pdf" required>
                            <div class="invalid-feedback">Please upload a valid book file (PDF, EPUB, DOCX).</div>
                        </div>

                        <button type="submit" class="btn btn-info" id="submit-book">Save Book</button>

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
        });
    </script>
</x-app-layout>