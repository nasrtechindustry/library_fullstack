<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Library Management System</title>
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Fonts -->
    <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
    <link rel="stylesheet" href="{{ asset('public/build/assets/app-CYmrHtAS.css') }}">
    <script type="module" src="{{ asset('public/build/assets/app-CfrlGjIS.js') }}"></script>

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
                <main class="custom-flow-b mb-5">

                    @auth

                    <section class=" container intro-section rounded mx-auto">
                        <div class="text-light text-center">
                            You are loggen as Student
                        </div>
                        <div class=" mt-5">
                            <!-- Search Bar -->
                            <!-- <div class="row mb-4">
                                <div class="col-md-12">
                                    <form method="GET" action="" class="d-flex">
                                        <select name="searchby" id="searchby" class="form-control me-2 w-25 input-search">
                                            <option selected>Search By</option>
                                            <option value="">Book</option>
                                            <option value="">Author</option>
                                            <option value="">Genre</option>
                                        </select>
                                        <input type="text" name="query" class="form-control me-2 input-search" placeholder="Search for books, authors, or genres..." value="{{ request('query') }}">
                                        <button type="submit" class="btn btn-outline-primary">Search</button>
                                    </form>
                                </div>
                            </div> -->

                            <div class="text-center text-custom " style="font-size: 28px">
                                This is the list of all books in the library
                            </div>

                            <!-- Books List -->
                            <div class="row">
                                @foreach ($books as $book)
                                <div class="col-md-4 mb-5">
                                    <div class="card shadow-lg rounded card-custom p-4">
                                        <div class="card-body">
                                            <div class="row justify-content-between">
                                                <div class="col-md-4">
                                                    @if ($book->image_url)
                                                    <img src="{{ $book->image_url }}" class="card-img-top p-4" alt="Book Image">
                                                    @else
                                                    <!-- Fallback to book icon if no image -->
                                                    <i class="fas fa-book text-left shadow p-4" style="font-size: 100px; color: blue; width: 100%;"></i>
                                                    @endif
                                                </div>
                                                <div class="col-md-8 ">
                                                    <h5 class="card-title text-custom" style="max-width: 200px;">{{ $book->title }}</h5>

                                                    <!-- Display authors for the current book -->
                                                    <div class="mb-3 d-flex  justify-content-center gap-2 flex-wrap">
                                                        <p>By:</p>
                                                        @foreach ($book->authors as $author)
                                                        <p class="text-white">{{ $author->firstname }}</p>
                                                        @endforeach
                                                    </div>

                                                    <!-- Description -->
                                                    <p class="card-text">{{ Str::limit($book->description, 100) }}</p>

                                                    <a href="{{ route('library.show', $book->id) }}" class="btn btn-outline-info btn-sm">View Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <!-- Pagination links for books -->
                            <div class="d-flex justify-content-center mt-4">
                                {{ $books->links() }}
                            </div>
                        </div>
                    </section>



                    @else
                    <section class="bg-transparent rules-section py-5 px-4 bg-light rounded shadow-sm mx-auto mb-5 " style="max-width: 1200px;">
                        <h1 class="display-4 fw-bold text-primary text-center ">Welcome to the Library </h1>
                        <!-- <p class="text-custom text-center mt-3">
                            Your gateway to knowledge, resources, and academic success. Explore, learn, and grow with ease.
                        </p> -->


                        <h2 class="text-center text-primary mb-4" style="font-weight: bold; font-size: 2.5rem;">
                            Library Rules & Guidelines
                        </h2>
                        <p class="text-center text-secondary mb-5" style="font-size: 1.2rem;">
                            Ensure a productive and respectful environment by following these rules.
                        </p>

                        <div class="row g-4 ">
                            <!-- Rule 1 -->
                            <div class="col-md-6 ">
                                <div class="rule-card d-flex align-items-start p-4 rounded shadow-sm">
                                    <i class="fas fa-book-reader text-primary me-4" style="font-size: 2.5rem;"></i>
                                    <div class="rule-card">
                                        <h5 class="fw-bold mb-2 text-custom">Respect Library Resources</h5>
                                        <p class="text-secondary mb-0">
                                            Handle all books, equipment, and resources with care. Return borrowed items on time to avoid penalties.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Rule 2 -->
                            <div class="col-md-6">
                                <div class="rule-card d-flex align-items-start p-4 rounded shadow-sm">
                                    <i class="fas fa-volume-mute text-danger me-4" style="font-size: 2.5rem;"></i>
                                    <div class="rule-card">
                                        <h5 class="fw-bold mb-2 text-custom">Maintain Silence</h5>
                                        <p class="text-secondary mb-0">
                                            Respect the quiet atmosphere. Keep noise to a minimum and use designated areas for group discussions.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Rule 3 -->
                            <div class="col-md-6">
                                <div class="rule-card d-flex align-items-start p-4  rounded shadow-sm">
                                    <i class="fas fa-clock text-warning me-4" style="font-size: 2.5rem;"></i>
                                    <div class="rule-card">
                                        <h5 class="fw-bold mb-2 text-custom">Adhere to Library Hours</h5>
                                        <p class="text-secondary mb-0">
                                            Use the library during official hours. Ensure you complete all transactions before closing time.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Rule 4 -->
                            <div class="col-md-6">
                                <div class="rule-card d-flex align-items-start p-4 rounded shadow-sm">
                                    <i class="fas fa-user-shield text-success me-4" style="font-size: 2.5rem;"></i>
                                    <div class="rule-card">
                                        <h5 class="fw-bold mb-2 text-custom">Respect Others</h5>
                                        <p class="text-secondary mb-0">
                                            Be considerate of other users. Avoid disruptive behaviors and treat everyone with respect.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Rule 5 -->
                            <div class="col-md-6">
                                <div class="rule-card d-flex align-items-start p-4  rounded shadow-sm">
                                    <i class="fas fa-laptop text-info me-4" style="font-size: 2.5rem;"></i>
                                    <div class="rule-card ">
                                        <h5 class="fw-bold mb-2 text-custom">Use Technology Responsibly</h5>
                                        <p class="text-secondary mb-0">
                                            Utilize library computers and internet access for academic or research purposes only.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Rule 6 -->
                            <div class="col-md-6">
                                <div class="rule-card d-flex align-items-start p-4  rounded shadow-sm">
                                    <i class="fas fa-trash-alt text-danger me-4" style="font-size: 2.5rem;"></i>
                                    <div class="rule-card ">
                                        <h5 class="fw-bold mb-2 text-custom">Keep the Space Clean</h5>
                                        <p class="text-secondary mb-0">
                                            Dispose of trash in designated bins and leave study areas tidy for the next user.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </section>

                    @endauth

                </main>
            </div>
        </div>
    </div>



    <div class="modal" id="profile">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="profile">
                    View Profile
                </div>
            </div>
        </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>