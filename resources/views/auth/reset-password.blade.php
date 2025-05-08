<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

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

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                {{ __('Contraseña') }}
            </label>
            <input id="password" type="password" name="password"
                class="w-full px-4 py-2 border border-gray-300 dark:border-[#3e3e3e]
                    rounded-lg bg-gray-50 dark:bg-[#3e3e3e]
                    text-gray-900 dark:text-gray-100
                    placeholder-gray-500 dark:placeholder-gray-400
                    focus:outline-none focus:ring-1 focus:ring-gray-500"
                placeholder="{{ __('Contraseña') }}"
                required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                {{ __('Confirmar contraseña') }}
            </label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                class="w-full px-4 py-2 border border-gray-300 dark:border-[#3e3e3e]
                    rounded-lg bg-gray-50 dark:bg-[#3e3e3e]
                    text-gray-900 dark:text-gray-100
                    placeholder-gray-500 dark:placeholder-gray-400
                    focus:outline-none focus:ring-1 focus:ring-gray-500"
                placeholder="{{ __('Confirmar contraseña') }}"
                required />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit"
                    class="px-6 py-2 bg-green-600 text-white font-bold rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                {{ __('Resetear contraseña') }}
            </button>
        </div>
    </form>
</x-guest-layout>
