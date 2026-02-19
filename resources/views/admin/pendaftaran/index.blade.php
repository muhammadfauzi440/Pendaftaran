@extends('admin.dashboard')

@section('content')
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-end mb-10">
            <div>
                <h1 class="text-4xl font-black text-gray-900 uppercase tracking-tighter">Kelola Pendaftar</h1>
                <p class="text-gray-500 font-bold mb-4">Total pengajuan masuk: {{ $pendaftarans->count() }}</p>

                <div class="flex flex-wrap gap-3 mb-6">
                    <a href="{{ route('admin.export.excel') }}"
                        class="flex items-center gap-2 bg-emerald-600 text-white px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-600/20">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Export Excel
                    </a>

                    <a href="{{ route('admin.export.pdf') }}"
                        class="flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] hover:bg-blue-700 transition-all shadow-lg shadow-blue-600/20">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        Export PDF
                    </a>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-600 rounded-r-2xl">
                <p class="text-emerald-600 font-bold text-xs uppercase tracking-widest">
                    {{ session('success') }}
                </p>
            </div>
        @endif

        <div class="bg-white border-2 border-gray-50 rounded-[2.5rem] shadow-sm overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-900 text-white text-[10px] font-black uppercase tracking-[0.2em]">
                    <tr>
                        <th class="px-8 py-5 text-left">Pendaftar</th>
                        <th class="px-8 py-5 text-left">Instansi</th>
                        <th class="px-8 py-5 text-center">Status</th>
                        <th class="px-8 py-5 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach ($pendaftarans as $p)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="px-8 py-6">
                                <div class="font-black text-gray-900">{{ $p->user->name }}</div>
                                <div class="text-[10px] text-gray-400 font-bold uppercase">{{ $p->nim_nisn }}</div>
                            </td>
                            <td class="px-8 py-6 text-sm font-bold text-gray-600">
                                {{ $p->instansi->nama_instansi ?? 'Instansi tidak ditemukan' }}
                            </td>
                            <td class="px-8 py-6 text-center">
                                <span
                                    class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest
                            {{ $p->status == 'pending' ? 'bg-amber-100 text-amber-600' : ($p->status == 'diterima' ? 'bg-emerald-100 text-emerald-600' : 'bg-red-100 text-red-600') }}">
                                    {{ $p->status }}
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex justify-end items-center gap-2">
                                    <a href="{{ route('admin.pendaftaran.show', $p->id) }}"
                                        class="bg-gray-100 hover:bg-gray-900 hover:text-white px-4 py-2.5 rounded-xl text-[10px] font-black uppercase transition-all shadow-sm group"
                                        title="Lihat Detail">
                                        Detail
                                    </a>
                                    <a href="{{ route('admin.pendaftaran.edit', $p->id) }}"
                                        class="bg-gray-100 hover:bg-blue-600 hover:text-white px-4 py-2.5 rounded-xl text-[10px] font-black uppercase transition-all shadow-sm"
                                        title="Edit Data">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.pendaftaran.destroy', $p->id) }}" method="POST"
                                        onsubmit="return confirm('Hapus permanen data {{ $p->user->name }}?')"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class=" hover:bg-red-900 text-white bg-red-600 hover:text-white px-4 py-2.5 rounded-xl text-[10px] font-black uppercase transition-all shadow-sm border border-red-100 hover:border-red-600">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
