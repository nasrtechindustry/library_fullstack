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
                        <li class="breadcrumb-item"><a href="{{ route('books.index')}}">Books</a></li>
                        <li class="breadcrumb-item active" aria-current="page">view</li>
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
                <div class="top my-5">
                    <div class="container ">
                        <div class="card shadow-sm border-0">
                            <div class="card-header bg-custom p-4 text-white d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Edit: {{ $book->title }}</h5>
                            </div>
                            <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <!-- Title -->
                                    <div class="mb-3">
                                        <label for="title" class="form-label">📖 Title</label>
                                        <input type="text" name="title" id="title" class="form-control" value="{{ $book->title }}" required>
                                    </div>

                                    <!-- Genre -->
                                    <div class="mb-3">
                                        <label for="genre_id" class="form-label">📚 Genre</label>
                                        <select name="genre_id" id="genre_id" class="form-select" required>
                                            <option value="" disabled>Select a Genre</option>
                                            @foreach ($genres as $genre)
                                            <option value="{{ $genre->id }}" {{ $book->genre_id == $genre->id ? 'selected' : '' }}>
                                                {{ $genre->genre_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Authors -->
                                    <div class="mb-3">
                                        <label for="authors" class="form-label">✍️ Authors</label>
                                        <select name="authors[]" id="authors" class="form-select" multiple  required>
                                            @foreach ($authors as $author)
                                            <option value="{{ $author->id }}"
                                                {{ in_array($author->id, $book->authors->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                {{ $author->firstname }} {{ $author->lastname }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <small class="text-muted">Hold Ctrl (Cmd on Mac) to select multiple authors.</small>
                                    </div>

                                    <!-- Publication Year -->
                                    <div class="mb-3">
                                        <label for="publication_year" class="form-label">📅 Publication Year</label>
                                        <input type="number" name="publication_year" id="publication_year" class="form-control"
                                            value="{{ $book->publication_year }}" required>
                                    </div>

                                    <!-- File -->
                                    <div class="mb-3">
                                        <label for="book_file" class="form-label">📁 File</label>
                                        <input type="file" name="book_file" id="book_file" class="form-control">
                                        @if($book->book_file)
                                        <p class="mt-2">
                                            Current File:
                                            <a href="{{ asset('storage/' . $book->book_file) }}" target="_blank" class="text-decoration-underline">
                                                Download File
                                            </a>
                                        </p>
                                        @else
                                        <p class="text-muted">No file uploaded.</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="card-footer text-center bg-light">
                                    <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">
                                        <i class="fas fa-arrow-left"></i> Cancel
                                    </a>
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-save"></i> Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
</x-app-layout>