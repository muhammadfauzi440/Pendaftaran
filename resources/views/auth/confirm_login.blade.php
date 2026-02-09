<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Sesi | PT GI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50 font-['Plus_Jakarta_Sans'] flex items-center justify-center min-h-screen p-6">
    <div class="max-w-md w-full bg-white rounded-[2.5rem] shadow-2xl p-10 text-center border border-gray-100">
        
        <div class="w-20 h-20 bg-red-50 text-red-600 rounded-full flex items-center justify-center mx-auto mb-8">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
        </div>

        <h3 class="text-2xl font-black text-gray-900 mb-4">Anda Sudah Masuk</h3>
        <p class="text-gray-500 mb-10 text-sm leading-relaxed">
            Sistem mendeteksi Anda sedang login sebagai <span class="font-bold text-gray-900">{{ Auth::user()->name }}</span>. <br>Apakah Anda ingin melanjutkan ke Dashboard atau keluar dari akun?
        </p>
        
        <div class="space-y-4">
            @if(Auth::user()->role == 'admin')
                <a href="{{ route('admin.dashboard') }}" class="block w-full py-4 bg-gray-900 text-white font-bold rounded-2xl hover:bg-black transition-all transform hover:-translate-y-1">
                    KE DASHBOARD
                </a>
            @else
                <a href="{{ route('user.dashboard') }}" class="block w-full py-4 bg-red-600 text-white font-bold rounded-2xl hover:bg-red-700 transition-all transform hover:-translate-y-1 shadow-lg shadow-red-600/20">
                    KE DASHBOARD
                </a>
            @endif

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full py-4 bg-white text-gray-400 font-bold rounded-2xl border border-gray-100 hover:bg-gray-50 transition-all hover:text-red-500 ">
                    KELUAR DARI AKUN
                </button>
            </form>
        </div>
    </div>
</body>
</html>