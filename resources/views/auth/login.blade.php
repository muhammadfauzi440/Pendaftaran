<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Portal Magang | PT GI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
</head>
<body class="bg-[#FDFDFD] font-['Plus_Jakarta_Sans']">
    @if (session('success'))
        <div class="fixed top-6 right-6 bg-gray-900 text-white px-6 py-4 rounded-2xl shadow-2xl z-50 flex items-center gap-3 border border-gray-800 animate-bounce">
            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
            </svg>
            <span class="text-sm font-bold">{{ session('success') }}</span>
        </div>
    @endif

    <div class="min-h-screen flex items-center justify-center p-6">
        <div class="max-w-md w-full bg-white rounded-[2.5rem] shadow-2xl p-10 md:p-12 border border-gray-100 text-center relative overflow-hidden">
            
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-red-50 rounded-full opacity-50"></div>
            <div class="absolute -bottom-10 -left-10 w-24 h-24 bg-gray-50 rounded-full opacity-50"></div>
            
            <a href="/">
                <img src="{{ asset('gambar/logo_gi.png') }}" class="w-48 mx-auto mb-10 relative z-10 hover:opacity-80 transition" alt="Logo">
            </a>
            
            <div class="relative z-10 mb-10">
                <h3 class="text-2xl font-black text-gray-900 mb-2">Selamat Datang</h3>
                <p class="text-gray-400 text-sm font-medium">Silakan masuk untuk melanjutkan pendaftaran</p>
            </div>
            
            @if ($errors->any())
                <div class="mb-8 p-4 bg-red-50 border border-red-100 text-red-600 rounded-2xl text-xs font-bold flex items-center gap-3">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-left">{{ $errors->first() }}</span>
                </div>
            @endif

            <form action="{{ url('/login') }}" method="POST" class="space-y-5 relative z-10">
                @csrf
                <div class="text-left">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 ml-4 mb-2 block">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full px-6 py-4 bg-gray-50 border rounded-2xl outline-none transition focus:ring-2 
                        {{ $errors->any() ? 'border-red-500 focus:ring-red-500' : 'border-gray-100 focus:ring-red-600' }}" 
                        placeholder="Masukkan Email Anda" required autocomplete="email">
                </div>

                <div class="text-left">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 ml-4 mb-2 block">Password</label>
                    <input type="password" name="password" 
                        class="w-full px-6 py-4 bg-gray-50 border rounded-2xl outline-none transition focus:ring-2 
                        {{ $errors->any() ? 'border-red-500 focus:ring-red-500' : 'border-gray-100 focus:ring-red-600' }}" 
                        placeholder="••••••••" required autocomplete="current-password">
                </div>

                <button type="submit" class="w-full py-5 bg-gray-900 text-white font-black rounded-2xl hover:bg-black transition-all transform hover:-translate-y-1 shadow-xl shadow-gray-900/20 uppercase tracking-widest text-sm">
                    Masuk Sekarang
                </button>
            </form>

            <div class="mt-10 pt-8 border-t border-gray-50 relative z-10">
                <p class="text-sm text-gray-400 font-medium">Belum memiliki akun? <br>
                    <a href="{{ route('register') }}" class="text-red-600 font-bold hover:text-red-700 transition-colors inline-block mt-2">Daftar Akun Peserta</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>