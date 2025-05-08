<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('¿Has olvidado tu contraseña? No hay problema. Solo déjanos saber tu dirección de correo electrónico y te enviaremos un enlace de restablecimiento de contraseña que te permitirá escoger una nueva.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                {{ __('Correo electrónico') }}
            </label>
            <input id="email" type="email" name="email" :value="old('email')"
                class="w-full px-4 py-2 border border-gray-300 dark:border-[#3e3e3e]
                       rounded-lg bg-gray-50 dark:bg-[#3e3e3e]
                       text-gray-900 dark:text-gray-100
                       placeholder-gray-500 dark:placeholder-gray-400
                       focus:outline-none focus:ring-1 focus:ring-gray-500"
                placeholder="{{ __('Correo electrónico') }}"
                required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit"
                    class="px-6 py-2 bg-green-600 text-white font-bold rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                {{ __('Enviar enlace') }}
            </button>
        </div>
    </form>
</x-guest-layout>
