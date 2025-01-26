<x-app-layout>
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white min-h-screen p-4">
            <h2 class="text-lg font-bold mb-4">Library Management</h2>
            @include('components.left-nav')
        </aside>

        <!-- Main Content -->
        <main class="flex-1 bg-gray-100 p-6 custom-flow">
            <div>
                <!-- Place main dashboard content here -->
                dashboard cards will be here
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

                @if (session('error') )

                <div class="alert alert-dismissible alert-danger">
                    {{session('error')}}
                </div>
                    
                @endif
            </div>
        </main>
    </div>
</x-app-layout>