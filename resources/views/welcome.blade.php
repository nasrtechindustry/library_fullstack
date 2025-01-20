<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Library Management System</title>

    <!-- Fonts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-image">
    <div class="wave">
        <div class="min-vh-100 ">
            <div class=" px-3">
                <!-- Header Section -->
                <header class="bg-custom-gradient row py-3 d-flex align-items-center justify-content-between glass">
                    <div class="col-md-6 col-12 mb-2 mb-md-0 text-center text-md-start">
                        <h1 class="header-text display-6">
                            Library Management System
                        </h1>
                    </div>
                    <div class="col-md-6 col-12 d-flex align-items-center justify-content-md-end">
                        @if (Route::has('login'))
                        <nav>
                            @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-outline-primary btn-sm me-2 mb-2 mb-md-0">Dashboard</a>
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
                <main class="mt-4 p-3">
                    <section class="intro-section p-4 rounded glass mx-auto" style="max-width: 1900px;">
                        <h2>Welcome to the Library Management System</h2>
                        <p>
                            The Library Management System helps you to manage, organize, and access your library's resources efficiently.
                            Enjoy a seamless experience whether you're borrowing books, maintaining records, or exploring collections.
                        </p>
                        <p>
                            Please log in or register to get started and explore all the features we have to offer.
                        </p>
                        <div class="container">
                            <a href="{{ route('login') }}" class="btn btn-primary me-2 mb-2 mb-md-0 w-25">Join</a>
                        </div>
                    </section>
                    
                </main>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>