<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - D'Lima Coffee</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-[Poppins] min-h-screen flex items-center justify-center p-4 bg-gradient-to-br from-[#2a1a10] via-[#5c3a21] to-[#C67C4E]">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl overflow-hidden p-8">
        <div class="text-center mb-8">
            <h3 class="text-2xl font-bold text-gray-800">Verifikasi OTP</h3>
            <p class="text-gray-500 text-sm mt-2">Kami telah mengirim kode OTP ke WhatsApp <strong>{{ $phone }}</strong></p>
        </div>

        @if (session('status'))
            <div class="mb-4 p-4 text-green-700 bg-green-100 rounded-lg text-sm">
                {{ session('status') }}
            </div>
        @endif
        
        @if ($errors->any())
             <div class="mb-4 p-4 text-red-700 bg-red-100 rounded-lg text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.verify.post') }}" class="space-y-6">
            @csrf
            <input type="hidden" name="phone" value="{{ $phone }}">
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Kode OTP (6 Digit)</label>
                <input type="text" name="otp" required maxlength="6"
                    class="w-full px-4 py-3 text-center text-2xl tracking-widest rounded-xl border-2 border-gray-100 focus:border-primary focus:ring-4 focus:ring-primary/20 outline-none transition-all"
                    placeholder="123456">
            </div>

            <button type="submit" class="w-full bg-primary hover:bg-[#A66236] text-white font-bold py-3 rounded-xl shadow-lg transition-all">
                Verifikasi
            </button>
        </form>
    </div>
</body>
</html>
