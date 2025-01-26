<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="w-100">
        @csrf
        
        <div>
            <h1 style="text-align:center; padding: 20px">
                LIBRARY MANAGEMENT SYSTEM
            </h1>
        </div>
        <div class="mt-4">
            <input type="hidden" value="student" name="roles" id="roles">
        </div>
        <div class="mt-4">
            <x-input-label for="reg_no" :value="__('Registration Number')" class="text-custom" />
            <x-text-input id="reg_no" class="block mt-1 w-full input-search" type="text" name="reg_no" :value="old('reg_no')" required autocomplete="reg_no" />
            <x-input-error :messages="$errors->get('reg_no')" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="first_name" :value="__('First Name')" class="text-custom" />
            <x-text-input id="first_name" class="block mt-1 w-full input-search" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" />
            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="last_name" :value="__('Last Name')" class="text-custom" />
            <x-text-input id="last_name" class="block mt-1 w-full input-search" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="last_name" />
            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="text-custom"/>
            <x-text-input id="email" class="block mt-1 w-full input-search" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-custom" />

            <x-text-input id="password" class="block mt-1 w-full input-search"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-custom" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full input-search"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
