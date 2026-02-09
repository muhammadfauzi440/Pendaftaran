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

        <aside class="w-72 bg-gray-900 p-8 flex flex-col justify-between fixed h-full">
            <div>
                <img src="{{ asset('gambar/logo_gi.png') }}" class="w-32 mb-12" alt="Logo">

                <nav class="space-y-4">
                    <a href="{{ route('user.dashboard') }}"
                        class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ Request::is('user/dashboard') ? 'bg-white/10 text-white font-bold' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                        <span class="text-sm tracking-wide">DASHBOARD</span>
                    </a>

                    <a href="/user/daftar"
                        class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ Request::is('user/daftar*') ? 'bg-white/10 text-white font-bold' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                        <span class="text-sm tracking-wide">PENDAFTARAN</span>
                    </a>

                    <a href="{{ route('profile.index') }}"
                        class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('profile.*') ? 'bg-red-600 text-white' : 'text-gray-400 hover:bg-white/5' }}">

                        <span class="text-sm tracking-wide">AKUN</span>
                    </a>
                </nav>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full py-4 bg-red-600 hover:bg-red-700 text-white text-xs font-black uppercase tracking-[0.2em] rounded-2xl shadow-lg shadow-red-900/20 transition-all transform hover:-translate-y-1">
                    Keluar Akun
                </button>
            </form>
        </aside>

        <main class="flex-1 p-12 ml-72">

            @hasSection('content')
                @yield('content')
            @else
                <div class="max-w-4xl">
                    <h1 class="text-4xl font-black text-gray-900 mb-2 uppercase tracking-tighter">Halo,
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
                                        <span class="text-gray-400 text-xs font-bold uppercase">Instansi</span>
                                        <span
                                            class="text-gray-900 font-black text-sm">{{ $pendaftaran->instansi->nama_instansi ?? '-' }}</span>
                                    </div>
                                    <div class="flex justify-between border-b border-gray-50 pb-3">
                                        <span class="text-gray-400 text-xs font-bold uppercase">Periode Magang</span>
                                        <span class="text-gray-900 font-black text-sm">
                                            {{ \Carbon\Carbon::parse($pendaftaran->tanggal_mulai)->format('d M') }} -
                                            {{ \Carbon\Carbon::parse($pendaftaran->tanggal_selesai)->format('d M Y') }}
                                        </span>
                                    </div>
                                    <div class="pt-4">
                                        <a href="/user/daftar"
                                            class="text-xs font-black text-red-600 hover:text-red-700 uppercase tracking-widest border-b-2 border-red-100">Lihat
                                            / Edit Detail &rarr;</a>
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
                            class="bg-white border-2 border-gray-50 p-8 rounded-[2.5rem] shadow-sm relative overflow-hidden">
                            <h2 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-6">Status
                                Pendaftaran</h2>

                            @if (isset($pendaftaran) && $pendaftaran)
                                <div
                                    class="inline-flex items-center px-6 py-2 rounded-full mb-6 font-black uppercase tracking-widest text-[10px]
            {{ $pendaftaran->status == 'pending' ? 'bg-amber-50 text-amber-600' : '' }}
            {{ $pendaftaran->status == 'diterima' ? 'bg-emerald-50 text-emerald-600' : '' }}
            {{ $pendaftaran->status == 'ditolak' ? 'bg-red-50 text-red-600' : '' }}">
                                    ● {{ strtoupper($pendaftaran->status) }}
                                </div>

                                @if ($pendaftaran->catatan_admin)
                                    <div class="mb-8 p-5 rounded-3xl bg-gray-50 border border-gray-100">
                                        <div class="flex items-center gap-2 mb-2">
                                            <svg class="w-3 h-3 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z">
                                                </path>
                                            </svg>
                                            <span
                                                class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Pesan
                                                Dari Admin GI:</span>
                                        </div>
                                        <p class="text-sm font-bold text-gray-700 leading-relaxed italic">
                                            "{{ $pendaftaran->catatan_admin }}"
                                        </p>
                                    </div>
                                @endif

                                <div class="space-y-4">
                                    <div class="flex justify-between border-b border-gray-50 pb-3">
                                        <span
                                            class="text-gray-400 text-xs font-bold uppercase tracking-tighter">Nama</span>
                                        <span
                                            class="text-gray-900 font-black text-sm">{{ $pendaftaran->user->name ?? '-' }}</span>
                                    </div>
                                    <div class="flex justify-between border-b border-gray-50 pb-3">
                                        <span
                                            class="text-gray-400 text-xs font-bold uppercase tracking-tighter">Instansi</span>
                                        <span
                                            class="text-gray-900 font-black text-sm">{{ $pendaftaran->instansi->nama_instansi ?? '-' }}</span>
                                    </div>
                                    <div class="flex justify-between border-b border-gray-50 pb-3">
                                        <span
                                            class="text-gray-400 text-xs font-bold uppercase tracking-tighter">Periode</span>
                                        <span class="text-gray-900 font-black text-sm">
                                            {{ \Carbon\Carbon::parse($pendaftaran->tanggal_mulai)->format('d M') }} -
                                            {{ \Carbon\Carbon::parse($pendaftaran->tanggal_selesai)->format('d M Y') }}
                                        </span>
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
                                    Jika Anda memiliki pertanyaan mengenai proses seleksi atau mengalami kendala teknis
                                    pada sistem, silakan hubungi kami melalui kanal bantuan.
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
