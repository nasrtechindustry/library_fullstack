<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="bg-custom">
        @csrf

        <div>
            <h1 style="text-align:center; padding: 20px; font-size: 20px;" class='text-primary '>
                LIBRARY MANAGEMENT SYSTEM
            </h1>
        </div>
        @if (session('error'))
        <div class="alert alert-danger alert-dismissible">
            {{session('error')}}
            <button class="btn btn-close"></button>
        </div>
        @endif
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-custom" />
            <x-text-input id="email" class="block mt-1 w-full input-search" type="email" name="email" :value="old('email')" required autofocus autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-custom" />

            <x-text-input id="password" class="block mt-1 w-full input-search"
                type="password"
                name="password"
                required autocomplete="current-password"
               />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="d-flex justify-content-between mt-4">
            <label for="remember_me" class="">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-custom">{{ __('Remember me') }}</span>
            </label>
            <a class="underline text-sm text-custom hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="/">Back</a>

        </div>

        <div class="flex items-center justify-between mt-4">
            <a class="underline text-sm text-custom hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register')}}">Have No account</a>
            @if (Route::has('password.request'))
            <a class="underline text-sm text-custom nav-link hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            @endif


        </div>
        <div class="d-flex justify-content-center mt-4">
            <x-primary-button class="w-100">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>