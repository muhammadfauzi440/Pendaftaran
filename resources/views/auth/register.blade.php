<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Magang | PT GI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
</head>

<body class="bg-[#FDFDFD] font-['Plus_Jakarta_Sans']">
    <div class="min-h-screen flex items-center justify-center p-6">
        <div class="max-w-4xl w-full bg-white rounded-[2.5rem] shadow-2xl overflow-hidden flex flex-col md:flex-row border border-gray-100">

            <div class="md:w-5/12 bg-gray-900 p-12 text-white flex flex-col justify-between relative">
                <div class="relative z-10">
                    <a href="/">
                        <img src="{{ asset('gambar/logo_gi.png') }}" class="w-40 mb-12" alt="Logo">
                    </a>
                    <h2 class="text-3xl font-extrabold mb-6 leading-tight">Mulai Karir Digitalmu Disini.</h2>
                    <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-red-600/20 rounded-full blur-3xl"></div>
                    <p class="text-gray-400 leading-relaxed text-sm">
                        Silakan buat akun terlebih dahulu untuk mengakses formulir pendaftaran magang di PT Global Intermedia Nusantara.
                    </p>
                </div>
                <p class="text-xs text-gray-500 relative z-10">© 2026 PT Global Intermedia Nusantara</p>
                <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-red-600/20 rounded-full blur-3xl"></div>
            </div>

            <div class="md:w-7/12 p-12">
                <h3 class="text-2xl font-black mb-8 text-gray-900">Registrasi Akun</h3>

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 text-red-600 rounded-xl text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ url('/register') }}" method="POST" class="space-y-5">
                    @csrf
                    
                    <div>
                        <label class="text-xs font-bold uppercase tracking-widest text-gray-400 ml-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full px-5 py-4 bg-gray-50 border rounded-2xl outline-none transition focus:ring-2 
                            {{ $errors->has('name') ? 'border-red-500 focus:ring-red-500' : 'border-gray-100 focus:ring-red-600' }}"
                            placeholder="Masukkan nama" required autocomplete="name">
                    </div>

                    <div>
                        <label class="text-xs font-bold uppercase tracking-widest text-gray-400 ml-1">Email (Username)</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full px-5 py-4 bg-gray-50 border rounded-2xl outline-none transition focus:ring-2 
                            {{ $errors->has('email') ? 'border-red-500 focus:ring-red-500' : 'border-gray-100 focus:ring-red-600' }}"
                            placeholder="Masukkan email" required autocomplete="email">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-bold uppercase tracking-widest text-gray-400 ml-1">Password</label>
                            <input type="password" name="password"
                                class="w-full px-5 py-4 bg-gray-50 border rounded-2xl outline-none transition focus:ring-2 
                                {{ $errors->has('password') ? 'border-red-500 focus:ring-red-500' : 'border-gray-100 focus:ring-red-600' }}"
                                placeholder="••••••••" required autocomplete="new-password">
                        </div>
                        <div>
                            <label class="text-xs font-bold uppercase tracking-widest text-gray-400 ml-1">Konfirmasi</label>
                            <input type="password" name="password_confirmation"
                                class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-red-600 outline-none transition"
                                placeholder="••••••••" required autocomplete="new-password">
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full py-5 bg-red-600 text-white font-black rounded-2xl hover:bg-red-700 shadow-xl shadow-red-600/30 transition-all transform hover:-translate-y-1">
                        BUAT AKUN SEKARANG
                    </button>
                </form>

                <p class="mt-8 text-center text-sm text-gray-500">
                    Sudah punya akun? <a href="{{ route('login') }}" class="text-red-600 font-bold hover:underline">Masuk di sini</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>