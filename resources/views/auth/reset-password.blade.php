<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - D'Lima Coffee</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-[Poppins] min-h-screen flex items-center justify-center p-4 bg-gradient-to-br from-[#2a1a10] via-[#5c3a21] to-[#C67C4E]">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl overflow-hidden p-8">
        <div class="text-center mb-8">
            <h3 class="text-2xl font-bold text-gray-800">Reset Password</h3>
            <p class="text-gray-500 text-sm mt-2">Silakan buat password baru untuk akun Anda.</p>
        </div>

        <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
            @csrf
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Password Baru</label>
                <input type="password" name="password" required minlength="8"
                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-100 focus:border-primary focus:ring-4 focus:ring-primary/20 outline-none transition-all"
                    placeholder="••••••••">
                @error('password')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required minlength="8"
                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-100 focus:border-primary focus:ring-4 focus:ring-primary/20 outline-none transition-all"
                    placeholder="••••••••">
            </div>

            <button type="submit" class="w-full bg-primary hover:bg-[#A66236] text-white font-bold py-3 rounded-xl shadow-lg transition-all">
                Simpan Password Baru
            </button>
        </form>
    </div>
</body>
</html>
