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
                    <div class="">
                        <div class="card shadow-sm border-0">
                            <div class="card-header bg-custom p-4 text-white d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">{{ $book->title }}</h5>
                                <span class="badge bg-info text-dark">{{ $book->publication_year }}</span>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <strong>📖 Genre:</strong>
                                    <span class="badge bg-secondary">{{ $book->genre->genre_name ?? 'N/A' }}</span>
                                </div>
                                <div class="mb-3 d-flex align-items-center">
                                    <strong>✍️ Author(s):</strong>
                                    <ul class="list-unstyled mt-2">
                                        @forelse ($book->authors as $author)
                                        <li class="d-inline-block me-3">
                                            <span class="badge bg-success">{{ $author->firstname }} {{ $author->lastname }}</span>
                                        </li>
                                        @empty
                                        <span class="text-muted">No authors available</span>
                                        @endforelse
                                    </ul>
                                </div>
                                <div class="mb-3">
                                    <strong>📅 Publication Year:</strong>
                                    <span class="text-muted">{{ $book->publication_year }}</span>
                                </div>
                                <div class="my-4">
                                    <strong>📁 File:</strong>
                                    @if($book->book_file)
                                    <a href="{{ asset('storage/' . $book->book_file) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-download"></i> Download File
                                    </a>
                                    <iframe  class="w-100 my-3" height="600" src="{{ asset('storage/' . $book->book_file) }}" frameborder="0"></iframe>
                                    @else
                                    <span class="text-muted">No file available</span>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer text-center bg-light">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-arrow-left"></i> Back
                                </a>
                                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
</x-app-layout>