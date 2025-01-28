<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Library Management System</title>
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Fonts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-image ">
    <div class=" ">
        <div class="min-vh-100 ">
            <div class=" p-0">
                <!-- Header Section -->
                <header class="row py-3 px-3 d-flex align-items-center justify-content-between glass">
                    <div class="col-md-6 col-12 mb-2 mb-md-0 text-center text-md-start">
                        <h1 class="header-text display-6">
                            Library Management System
                        </h1>


                    </div>
                    <div class="col-md-6 col-12 d-flex align-items-center justify-content-md-end">
                        @if (Route::has('login'))
                        <nav>
                            @auth
                            <div class="d-flex">
                                @if (auth()->check() && auth()->user()->roles === 'student')
                                <a href="#" class="d-flex align-items-center text-info nav-link me-2 mb-2 mb-md-0">
                                    Welcome back {{ auth()->user()->first_name }}
                                </a>
                                <a href="#" class="d-flex align-items-center btn btn-outline-primary btn-sm me-2 mb-2 mb-md-0">
                                    Profile
                                </a>
                                @else
                                <a href="{{ url('/dashboard') }}" class="d-flex align-items-center btn btn-outline-primary btn-sm me-2 mb-2 mb-md-0">
                                    Dashboard
                                </a>
                                @endif

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('You are about to sign out the library')">
                                    @csrf
                                    @method('post')
                                    <button class="btn btn-outline-danger">Logout</button>
                                </form>
                            </div>

                            @else
                            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm  me-2 mb-2 mb-md-0">Log in</a>
                            @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-outline-primary btn-sm">Register</a>
                            @endif
                            @endauth
                        </nav>
                        @endif
                    </div>
                </header>



                <!-- Main Section -->
                <main class="custom-flow-b mb-5 ">


                    <div class="container mb-5">
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible mt-2 fade show">
                            <button class="btn btn-close" data-bs-dismiss="alert"></button>
                            {{session('success')}}
                        </div>
                        @endif

                        @if (session('error'))
                        <div class="alert alert-danger alert-dismissible mt-2 fade show">
                            <button class="btn btn-close" data-bs-dismiss="alert"></button>
                            {{session('error')}}
                        </div>
                        @endif
                        <div class="top  p-5">
                            <div class="">
                                <div class="card shadow-sm border-0 card-custom my-3">
                                    <div class="card-header bg-custom p-4 text-white d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0  text-gradient">{{ $book->title }}</h5>
                                        <span class="text-gradient">{{ $book->publication_year }}</span>
                                    </div>
                                    <div class="card-body text-custom">
                                        <div class="mb-3">
                                            <strong>📖 Genre:</strong>
                                            <span class="text-light bg-custom rounded px-2">{{ $book->genre->genre_name ?? 'N/A' }}</span>
                                        </div>
                                        <div class="mb-3 d-flex align-items-center">
                                            <strong>✍️ Author(s):</strong>
                                            <ul class="list-unstyled mt-2">
                                                @forelse ($book->authors as $author)
                                                <li class="d-inline-block me-3">
                                                    <span class="text-light bg-custom rounded px-2">{{ $author->firstname }} {{ $author->lastname }}</span>
                                                </li>
                                                @empty
                                                <span class="text-muted">No authors available</span>
                                                @endforelse
                                            </ul>
                                        </div>
                                        <div class="mb-3">
                                            <strong>📅 Publication Year:</strong>
                                            <span class="text-light bg-custom rounded px-2">{{ $book->publication_year }}</span>
                                        </div>
                                        <div class="my-4">
                                            <!-- <strong>📁 File:</strong>
                                            @if($book->book_file)
                                            <a href="{{ asset('storage/' . $book->book_file) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-download"></i> Download File
                                            </a> -->
                                            <iframe class="w-100 my-3" height="600" src="{{ asset('storage/' . $book->book_file) }}" frameborder="0"></iframe>
                                            @else
                                            <span class="text-muted">No file available</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card-footer text-center p-3">
                                        <a href="/" class="btn btn-secondary btn-sm">
                                            <i class="fas fa-arrow-left"></i> Back
                                        </a>
                                        <a href="{{ route('library.requestBook', $book->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-request"></i> Request Book
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </main>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>