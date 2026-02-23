<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard | PT GI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-[#FDFDFD] font-['Plus_Jakarta_Sans']">
    <div class="flex min-h-screen">

        <aside class="w-72 bg-gray-900 p-8 flex flex-col fixed h-full z-50">
            <div>
                <img src="{{ asset('gambar/logo_gi.png') }}" class="w-32 mb-12" alt="Logo">

                <nav class="space-y-3">
                    <a href="{{ route('user.dashboard') }}"
                        class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-300 {{ Request::is('user/dashboard') ? 'bg-white/10 text-white font-bold' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span class="text-sm tracking-wide">DASHBOARD</span>
                    </a>

                    <a href="/user/daftar"
                        class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-300 {{ Request::is('user/daftar*') ? 'bg-white/10 text-white font-bold' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span class="text-sm tracking-wide">PENDAFTARAN</span>
                    </a>

                    <a href="{{ route('profile.index') }}"
                        class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('profile.*') ? 'bg-white/10 text-white font-bold' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="text-sm tracking-wide">AKUN</span>
                    </a>

                    <div class="pt-4">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="flex items-center gap-4 w-full px-4 py-4 bg-red-600 hover:bg-red-700 text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-2xl shadow-lg shadow-red-900/20 transition-all transform hover:-translate-y-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                KELUAR AKUN
                            </button>
                        </form>
                    </div>
                </nav>
            </div>
        </aside>

        <main class="flex-1 p-12 ml-72">

            @hasSection('content')
                @yield('content')
            @else
                <div class="max-w-4xl">
                    <h1 class="text-4xl font-black text-gray-900 mb-2 uppercase tracking-tighter italic">Halo,
                        {{ auth()->user()->name }}! 👋</h1>
                    <p class="text-gray-500 mb-10 text-lg">Selamat datang di portal magang PT Global Intermedia.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="bg-white border-2 border-gray-50 p-8 rounded-[2.5rem] shadow-sm">
                            <h2 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-6">Status
                                Pendaftaran</h2>

                            @if (isset($pendaftaran) && $pendaftaran)
                                <div
                                    class="inline-flex items-center px-6 py-2 rounded-full mb-6 font-black uppercase tracking-widest text-[10px]
                                    {{ $pendaftaran->status == 'pending' ? 'bg-amber-50 text-amber-600' : '' }}
                                    {{ $pendaftaran->status == 'diterima' ? 'bg-emerald-50 text-emerald-600' : '' }}
                                    {{ $pendaftaran->status == 'ditolak' ? 'bg-red-50 text-red-600' : '' }}">
                                    ● {{ $pendaftaran->status }}
                                </div>

                                <div class="space-y-4">
                                    <div class="flex justify-between border-b border-gray-50 pb-3">
                                        <span class="text-gray-400 text-xs font-bold uppercase">Nama</span>
                                        <span
                                            class="text-gray-900 font-black text-sm">{{ $pendaftaran->user->name ?? '-' }}</span>
                                    </div>
                                    <div class="flex justify-between border-b border-gray-50 pb-3">
                                        <span class="text-gray-400 text-xs font-bold uppercase">Instansi</span>
                                        <span
                                            class="text-gray-900 font-black text-sm">{{ $pendaftaran->instansi->nama_instansi ?? '-' }}</span>
                                    </div>
                                    <div class="flex justify-between border-b border-gray-50 pb-3">
                                        <span class="text-gray-400 text-xs font-bold uppercase">Periode</span>
                                        <span class="text-gray-900 font-black text-sm">
                                            {{ \Carbon\Carbon::parse($pendaftaran->tanggal_mulai)->format('d M') }} -
                                            {{ \Carbon\Carbon::parse($pendaftaran->tanggal_selesai)->format('d M Y') }}
                                        </span>
                                    </div>
                                    <div class="pt-6">
                                        <a href="/user/daftar"
                                            class="inline-block bg-red-600 text-white px-8 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-red-700 transition-all shadow-lg shadow-red-600/20 transform hover:-translate-y-0.5">
                                            Lihat Detail &rarr;
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="py-6 text-center">
                                    <p class="text-gray-400 mb-8 italic text-sm">Anda belum melengkapi formulir
                                        pendaftaran.</p>
                                    <a href="/user/daftar"
                                        class="inline-block bg-gray-900 text-white px-10 py-4 rounded-2xl text-xs font-black uppercase tracking-[0.2em] hover:bg-red-600 transition shadow-xl shadow-gray-200">
                                        Daftar Sekarang
                                    </a>
                                </div>
                            @endif
                        </div>

                        <div
                            class="bg-gray-900 p-8 rounded-[2.5rem] shadow-2xl text-white flex flex-col justify-between">
                            <div>
                                <h2 class="text-xs font-black text-gray-500 uppercase tracking-widest mb-6">Informasi
                                    Bantuan</h2>
                                <p class="text-sm leading-relaxed text-gray-300 mb-6 font-medium">
                                    Jika Anda memiliki pertanyaan mengenai proses seleksi, silakan hubungi kami.
                                </p>
                            </div>
                            <a href="https://wa.me/6287782521039" target="_blank"
                                class="inline-flex items-center justify-center bg-white/10 border border-white/20 py-4 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] hover:bg-white hover:text-gray-900 transition">
                                Hubungi via WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </main>
    </div>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'BERHASIL',
                text: "{{ session('success') }}",
                confirmButtonColor: '#111827',
                customClass: {
                    popup: 'rounded-[2rem]',
                    confirmButton: 'rounded-xl uppercase font-black tracking-widest text-xs py-3 px-6'
                }
            });
        </script>
    @endif
</body>

</html>
