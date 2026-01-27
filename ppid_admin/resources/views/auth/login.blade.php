<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-xl font-bold text-gray-800 uppercase">Politeknik Keselamatan Transportasi Jalan</h2>
        <p class="text-sm text-gray-600">SILAHKAN LOGIN UNTUK MULAI MENGGUNAKAN</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf <div class="mt-4">
            <x-input-label for="login" value="Username / Email" />
            <x-text-input id="login" class="block mt-1 w-full" type="text" name="login" :value="old('login')" required autofocus />
            <x-input-error :messages="$errors->get('login')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="w-full justify-center py-3">
                MASUK
            </x-primary-button>
        </div>

        <div class="mt-6 text-center text-sm">
            Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Daftar di sini</a>
        </div>
    </form>
</x-guest-layout>