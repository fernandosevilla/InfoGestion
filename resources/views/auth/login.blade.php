<x-guest-layout>
    <div class="mb-2 text-center">
        <x-auth-session-status class="mb-4" :status="session('status')" />
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                {{ __('Correo electrónico') }}
            </label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                   class="w-full px-4 py-2 border border-gray-300 dark:border-[#3e3e3e]
                          rounded-lg bg-gray-50 dark:bg-[#3e3e3e]
                          text-gray-900 dark:text-gray-100
                          placeholder-gray-500 dark:placeholder-gray-400
                          focus:outline-none focus:ring-1 focus:ring-gray-500"
                          placeholder="{{ __('Correo electrónico') }}"/>
            @error('email')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                {{ __('Contraseña') }}
            </label>
            <input id="password" name="password" type="password" required
                   class="w-full px-4 py-2 border border-gray-300 dark:border-[#3e3e3e]
                          rounded-lg bg-gray-50 dark:bg-[#3e3e3e]
                          text-gray-900 dark:text-gray-100
                          placeholder-gray-500 dark:placeholder-gray-400
                          focus:outline-none focus:ring-1 focus:ring-gray-500"
                          placeholder="{{ __('Contraseña') }}" />
            @error('password')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        {{-- Remember Me --}}
        <div class="flex items-center">
            <input id="remember_me" name="remember" type="checkbox"
                   class="h-4 w-4 text-orange-500 rounded border-gray-300 dark:bg-[#3e3e3e] dark:border-[#444444]
                          focus:ring-orange-500 dark:focus:ring-orange-600 dark:focus:ring-offset-gray-800" />
            <label for="remember_me" class="ms-2 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Recordarme') }}
            </label>
        </div>

        {{-- Enlaces y botón --}}
        <div class="flex items-center justify-between">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   class="text-sm underline text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                    {{ __('¿Has olvidado tu contraseña?') }}
                </a>
            @endif

            <button type="submit"
                    class="px-6 py-2 bg-green-600 text-white font-bold rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                {{ __('Iniciar sesión') }}
            </button>
        </div>
    </form>
</x-guest-layout>
