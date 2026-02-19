<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PPID PKTJ</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans bg-gradient-to-br from-blue-600 via-blue-700 to-blue-900">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <!-- Main Container -->
        <div class="w-full sm:max-w-md">
            <!-- Logo Section -->
            <div class="mb-8 text-center">
                <!-- Logo PKTJ (Placeholder) -->
                <div class="flex justify-center mb-6">
                    <div class="w-24 h-24 rounded-full bg-white shadow-xl flex items-center justify-center">
                        <div class="text-center">
                            <div class="text-5xl mb-2">🛣️</div>
                            <p class="text-xs font-bold text-blue-600">PKTJ</p>
                        </div>
                    </div>
                </div>
                <h2 class="text-2xl font-bold text-white uppercase">Politeknik Keselamatan </h2>
                <h2 class="text-2xl font-bold text-yellow-300 uppercase">Transportasi Jalan</h2>
            </div>

            <!-- Login Card -->
            <div class="w-full px-6 py-8 bg-white shadow-2xl overflow-hidden rounded-2xl border-t-4 border-blue-600">
                <div class="mb-6 text-center">
                    <p class="text-sm text-gray-600 font-semibold">SISTEM INFORMASI PPID</p>
                    <p class="text-xs text-gray-500 mt-1">Silahkan login untuk mulai menggunakan</p>
                </div>

                <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-4">
                    <?php echo csrf_field(); ?> 

                    <!-- Email Input -->
                    <div>
                        <label class="block font-medium text-sm text-gray-700 mb-2">📧 Alamat Email</label>
                        <input id="email" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200 transition" type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus />
                        <?php if($errors->has('email')): ?>
                            <p class="text-sm text-red-600 mt-2"><?php echo e($errors->first('email')); ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Password Input -->
                    <div>
                        <label class="block font-medium text-sm text-gray-700 mb-2">🔐 Kata Sandi</label>
                        <div class="relative">
                            <input id="password_login" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200 transition" type="password" name="password" required />
                            <button type="button" onclick="togglePassword('password_login')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-sm text-blue-600 font-bold hover:text-blue-800">
                                LIHAT
                            </button>
                        </div>
                        <?php if($errors->has('password')): ?>
                            <p class="text-sm text-red-600 mt-2"><?php echo e($errors->first('password')); ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="w-full mt-6 px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-800 text-white font-bold rounded-lg shadow-lg hover:shadow-xl hover:from-blue-700 hover:to-blue-900 transition transform duration-200 uppercase tracking-wide">
                        🔓 MASUK
                    </button>
                </form>

                <!-- Footer -->
                <div class="mt-6 pt-4 border-t border-gray-200 text-center">
                    <p class="text-xs text-gray-600">
                        © 2026 PPID PKTJ. All rights reserved.
                    </p>
                </div>
            </div>

            <!-- Footer Text -->
            <div class="mt-6 text-center text-white text-sm">
                <p>Hubungi administrator jika ada pertanyaan</p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            input.type = input.type === "password" ? "text" : "password";
        }
    </script>
</body>
</html><?php /**PATH C:\laragon\www\PPID-PKTJ\resources\views/auth/login.blade.php ENDPATH**/ ?>