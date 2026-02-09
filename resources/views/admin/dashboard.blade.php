<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | PT Global Intermedia</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap"
        rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-50 font-['Plus_Jakarta_Sans']" x-data="{ sidebarOpen: true }">

    <aside :class="sidebarOpen ? 'w-64' : 'w-20'"
        class="fixed left-0 top-0 h-screen bg-gray-900 text-white transition-all duration-300 z-50">
        <div class="p-6 flex items-center gap-4 border-b border-gray-800">
            <span x-show="sidebarOpen" class="font-bold text-lg whitespace-nowrap">Admin <span
                    class="text-red-600">Dashboard</span></span>
        </div>

        <nav class="mt-8 px-4 space-y-2 flex flex-col h-[calc(100vh-120px)]">
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-4 px-4 py-3 {{ Request::is('admin/dashboard') ? 'bg-red-600' : 'text-gray-400 hover:bg-gray-800' }} rounded-xl transition">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                    </path>
                </svg>
                <span x-show="sidebarOpen" class="font-bold whitespace-nowrap">Dashboard</span>
            </a>

            <a href="{{ route('admin.pendaftaran.index') }}"
                class="flex items-center gap-4 px-4 py-3 {{ Request::is('admin.pendaftaran.show') ? 'bg-red-600' : 'text-gray-400 hover:bg-gray-800' }} rounded-xl transition">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                    </path>
                </svg>
                <span x-show="sidebarOpen" class="font-bold whitespace-nowrap">Data Pendaftar</span>
            </a>

            <a href="{{ route('profile.index') }}"
                class="flex items-center gap-4 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('profile.*') ? 'bg-red-600 text-white' : 'text-gray-400 hover:bg-white/5' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span x-show="sidebarOpen" class="font-bold whitespace-nowrap">Akun</span>
            </a>


            <form action="{{ route('logout') }}" method="POST" class="pb-6">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-4 px-4 py-3 text-red-500 hover:bg-red-500/10 rounded-xl transition group cursor-pointer">
                    <svg class="w-5 h-5 shrink-0 group-hover:scale-110 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    <span x-show="sidebarOpen"
                        class="font-black text-xs uppercase tracking-[0.2em] whitespace-nowrap">Logout</span>
                </button>
            </form>
        </nav>
    </aside>

    <div :class="sidebarOpen ? 'ml-64' : 'ml-20'" class="transition-all duration-300">
        <header class="h-20 bg-white border-b border-gray-100 flex items-center justify-between px-8 sticky top-0 z-40">
            <button @click="sidebarOpen = !sidebarOpen" class="p-2 hover:bg-gray-50 rounded-lg text-gray-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
        </header>

        <div class="p-8">
            @hasSection('content')
                @yield('content')
            @else
                <div class="mb-10">
                    <h1 class="text-2xl font-black text-gray-900">Dashboard Overview</h1>
                    <p class="text-gray-500 text-sm">Statistik pendaftaran magang terbaru.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Total Peserta</p>
                        <h2 class="text-4xl font-black text-gray-900 mt-2">{{ $stats['total'] ?? 0 }}</h2>
                    </div>
                    <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Total Pending</p>
                        <h2 class="text-4xl font-black text-amber-500 mt-2">{{ $stats['pending'] ?? 0 }}</h2>
                    </div>
                    <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Total Diterima</p>
                        <h2 class="text-4xl font-black text-emerald-600 mt-2">{{ $stats['diterima'] ?? 0 }}</h2>
                    </div>
                    <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Total Ditolak</p>
                        <h2 class="text-4xl font-black text-red-600 mt-2">{{ $stats['ditolak'] ?? 0 }}</h2>
                    </div>
                </div>
            @endif
        </div>
    </div>
</body>

</html>
