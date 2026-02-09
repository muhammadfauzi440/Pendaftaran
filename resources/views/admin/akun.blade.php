@extends('admin.dashboard')

@section('content')
    <div class="p-8">
        <div class="max-w-6xl mx-auto">

            <div class="flex justify-between items-center mb-10">
                <div>
                    <h2 class="text-2xl font-black text-gray-900 uppercase tracking-[0.3em]">Kelola Pengguna</h2>
                    <p class="text-gray-500 text-[10px] font-bold uppercase mt-2">Total: {{ $allUsers->count() }} Pengguna
                        Terdaftar</p>
                </div>
                <button onclick="toggleModal('modalTambah')"
                    class="bg-red-600 text-white px-8 py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-red-700 transition-all shadow-lg shadow-red-600/20">
                    + Tambah Akun Baru
                </button>
            </div>

            @if (session('success'))
                <div
                    class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-xs font-bold text-center">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white/5 border border-white/10 rounded-[2.5rem] overflow-hidden backdrop-blur-sm">
                <table class="w-full text-left">
                    <thead class="bg-white/5 text-[10px] font-black uppercase text-gray-500 tracking-widest">
                        <tr>
                            <th class="px-8 py-6">Nama Pengguna</th>
                            <th class="px-8 py-6">Email</th>
                            <th class="px-8 py-6">Role</th>
                            <th class="px-8 py-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-white border-t border-white/10">
                        @foreach ($allUsers as $u)
                            <tr class="border-b border-white/5 hover:bg-white/5 transition-all">
                                <td class="px-8 py-5 font-bold text-gray-600">{{ $u->name }}</td>
                                <td class="px-8 py-5 text-gray-600">{{ $u->email }}</td>
                                <td class="px-8 py-5">
                                    <span
                                        class="px-4 py-1.5 rounded-full text-[9px] font-black uppercase {{ $u->role == 'admin' ? 'bg-red-500/20 text-red-500' : 'bg-blue-500/20 text-blue-500' }}">
                                        {{ $u->role }}
                                    </span>
                                </td>
                                <td class="px-8 py-5 flex justify-center gap-3">
                                    <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-3 bg-red-500/10 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="modalTambah" class="hidden fixed inset-0 z-50 items-center justify-center bg-black/80 backdrop-blur-sm p-4">
        <div class="bg-[#0f172a] border border-white/10 w-full max-w-lg rounded-[2.5rem] p-10 shadow-2xl">
            <h3 class="text-white font-black uppercase tracking-widest mb-8 text-center">Tambah User Baru</h3>
            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-5">
                @csrf
                <input type="text" name="name" placeholder="Nama Lengkap"
                    class="w-full bg-white border-2 border-gray-100 rounded-2xl px-6 py-4 text-gray-900 font-bold outline-none focus:border-red-600"
                    required>
                <input type="email" name="email" placeholder="Email"
                    class="w-full bg-white border-2 border-gray-100 rounded-2xl px-6 py-4 text-gray-900 font-bold outline-none focus:border-red-600"
                    required>
                <input type="password" name="password" placeholder="Password"
                    class="w-full bg-white border-2 border-gray-100 rounded-2xl px-6 py-4 text-gray-900 font-bold outline-none focus:border-red-600"
                    required>
                <select name="role"
                    class="w-full bg-white border-2 border-gray-100 rounded-2xl px-6 py-4 text-gray-900 font-bold outline-none focus:border-red-600">
                    <option value="user">User (Pendaftar)</option>
                    <option value="admin">Admin</option>
                </select>
                <div class="flex gap-4 pt-4">
                    <button type="button" onclick="toggleModal('modalTambah')"
                        class="w-1/2 py-4 text-gray-500 font-black uppercase text-[10px] tracking-widest">Batal</button>
                    <button type="submit"
                        class="w-1/2 py-4 bg-red-600 text-white font-black uppercase text-[10px] tracking-widest rounded-2xl hover:bg-red-700">Simpan
                        User</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModal(id) {
            const modal = document.getElementById(id);
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            } else {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }

        window.onclick = function(event) {
            const modal = document.getElementById('modalTambah');

            if (event.target == modal) {
                toggleModal('modalTambah');
            }
        }
    </script>
@endsection
