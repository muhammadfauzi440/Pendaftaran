@extends('admin.dashboard')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-end mb-10">
        <div>
            <h1 class="text-4xl font-black text-gray-900 uppercase tracking-tighter">Kelola Pendaftar</h1>
            <p class="text-gray-500 font-bold">Total pengajuan masuk: {{ $pendaftarans->count() }}</p>
        </div>
    </div>

    <div class="bg-white border-2 border-gray-50 rounded-[2.5rem] shadow-sm overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-900 text-white text-[10px] font-black uppercase tracking-[0.2em]">
                <tr>
                    <th class="px-8 py-5 text-left">Pendaftar</th>
                    <th class="px-8 py-5 text-left">Instansi</th>
                    <th class="px-8 py-5 text-center">Status</th>
                    <th class="px-8 py-5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($pendaftarans as $p)
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="px-8 py-6">
                        <div class="font-black text-gray-900">{{ $p->user->name }}</div>
                        <div class="text-[10px] text-gray-400 font-bold uppercase">{{ $p->nim_nisn }}</div>
                    </td>
                    <td class="px-8 py-6 text-sm font-bold text-gray-600">
                        {{ $p->instansi->nama_instansi }}
                    </td>
                    <td class="px-8 py-6 text-center">
                        <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest
                            {{ $p->status == 'pending' ? 'bg-amber-100 text-amber-600' : ($p->status == 'diterima' ? 'bg-emerald-100 text-emerald-600' : 'bg-red-100 text-red-600') }}">
                            {{ $p->status }}
                        </span>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <a href="{{ route('admin.pendaftaran.show', $p->id) }}" class="inline-block bg-gray-100 hover:bg-red-600 hover:text-white px-6 py-2.5 rounded-xl text-[10px] font-black uppercase transition-all shadow-sm">
                            Detail & Verifikasi &rarr;
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection