<x-guest-layout>

    <div class="max-w-md mx-auto bg-white shadow-lg rounded-xl p-8">

        <h2 class="text-2xl font-bold text-center text-gray-800 mb-2">
            Daftar Akun
        </h2>

        <p class="text-center text-gray-500 mb-6">
            Bergabung sebagai Customer atau Merchant Katering
        </p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name"
                    class="block mt-1 w-full rounded-lg"
                    type="text"
                    name="name"
                    :value="old('name')"
                    required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email"
                    class="block mt-1 w-full rounded-lg"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password"
                    class="block mt-1 w-full rounded-lg"
                    type="password"
                    name="password"
                    required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation"
                    class="block mt-1 w-full rounded-lg"
                    type="password"
                    name="password_confirmation"
                    required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Role -->
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700">
                    Register sebagai
                </label>

                <select name="role"
                    class="mt-1 w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">

                    <option value="customer">Customer (Kantor / Pembeli)</option>
                    <option value="merchant">Merchant (Penyedia Katering)</option>

                </select>
            </div>

            <!-- Action -->
            <div class="flex items-center justify-between mt-6">

                <a class="text-sm text-gray-600 hover:text-green-600"
                    href="{{ route('login') }}">
                    Sudah punya akun?
                </a>

                <x-primary-button class="bg-green-600 hover:bg-green-700">
                    Register
                </x-primary-button>

            </div>

        </form>

    </div>

</x-guest-layout>