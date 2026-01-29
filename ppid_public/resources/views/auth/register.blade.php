<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - PPID PKTJ</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="mb-4 text-center">
                <h2 class="text-xl font-bold text-gray-800">Registrasi Akun Pemohon Informasi</h2>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700">Nama Lengkap</label>
                    <input id="name" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" type="text" name="name" value="{{ old('name') }}" required autofocus />
                </div>

                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700">Alamat Email</label>
                    <input id="email" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" type="email" name="email" value="{{ old('email') }}" required />
                    @if($errors->has('email'))
                        <p class="text-sm text-red-600 mt-2">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700">Kata Sandi</label>
                    <div class="relative">
                        <input id="password" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" type="password" name="password" required />
                        <button type="button" onclick="togglePassword('password')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm text-blue-600 font-semibold">LIHAT</button>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700">Konfirmasi Kata Sandi</label>
                    <div class="relative">
                        <input id="password_confirmation" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" type="password" name="password_confirmation" required />
                        <button type="button" onclick="togglePassword('password_confirmation')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm text-blue-600 font-semibold">LIHAT</button>
                    </div>
                </div>

                <div class="mt-4 flex items-start">
                    <input id="agree" name="agree" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" required>
                    <label for="agree" class="ml-2 text-sm italic text-gray-600">Pastikan data yang diunggah telah sesuai.</label>
                </div>

                <div class="flex items-center justify-end mt-6">
                    <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none transition ease-in-out duration-150">
                        Simpan Pendaftaran
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            input.type = input.type === "password" ? "text" : "password";
        }
    </script>
</body>
</html>