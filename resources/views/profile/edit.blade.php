<x-app-layout>
    <div class="flex">
        <div class="some">

            <aside class="w-64 bg-gray-800 text-white min-h-screen p-4">
                <h2 class="text-lg font-bold mb-4">Library Management</h2>
                @include('components.left-nav')
            </aside>

        </div>
        <!-- Main Content -->
        <main class="flex-1 bg-gray-100 p-2 custom-flow">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>