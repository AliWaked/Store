<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class=" text-4xl font-extrabold text-center mb-12 mt-4">
        Login
    </div>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class=" relative">
            <span class=" absolute w-12 h-[3px] bg-white -top-[2px] left-3"></span>
            <x-input-label for="email" :value="__('Email *')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-6 relative">
            <span class=" absolute w-20 h-[3px] bg-white -top-[2px] left-3"></span>
            <x-input-label for="password" :value="__('Password *')" />
            <x-text-input id="password" class="block mt-1 w-full " type="password" name="password" required
                autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div class="mt-6">
            <button type="submit" class="text-white w-full bg-red-600 rounded-xl py-2 uppercase">
                {{ __('Login') }}
            </button>
        </div>
    </form>
    <form action="{{ route('auth.socialite.redirect', 'google') }}" method="get">
        <div class="mt-6">
            <button type="submit" class="text-white w-full bg-blue-600 rounded-xl py-2 uppercase">
                {{ __('continue with google') }}
            </button>
        </div>
    </form>
</x-guest-layout>
