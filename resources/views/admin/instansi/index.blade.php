@extends('admin.dashboard')

@section('content')
    <div class="mb-10">
        <h1 class="text-2xl font-black text-gray-900">Kelola Instansi</h1>
        <p class="text-gray-500 text-sm">Tambah atau hapus daftar Instansi</p>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white p-8 rounded-2xl border border-gray-200 shadow-sm mb-8">
        <form action="{{ route('admin.instansi.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <input class="border p-3 rounded-xl text-sm" type="text" name="nama_instansi" placeholder="Nama Instansi"
                    required>
                <input class="border p-3 rounded-xl text-sm" type="text" name="alamat_instansi"
                    placeholder="Alamat Instansi" required>
                <input class="border p-3 rounded-xl text-sm" type="text" name="kontak_instansi"
                    placeholder="Kontak Instansi" required>
                <select class="border p-3 rounded-xl text-sm" name="tipe" id="tipe" required>
                    <option value="" disabled selected>Pilih Tipe Instansi</option>
                    <option value="sekolah">Sekolah</option>
                    <option value="universitas">Universitas</option>
                </select>

                <button type="submit"
                    class="mt-4 bg-red-600 text-white px-6 py-2 rounded-xl font-bold text-sm">Simpan</button>
            </div>
        </form>
    </div>

    <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="relative w-full md:w-1/2">
            <form action="{{ route('admin.instansi.index') }}" method="GET" class="flex gap-2">
                <div class="relative ">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="w-full pl-12 pr-6 py-2 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition-all" placeholder="Cari nama Instansi">
                </div>
                <button type="submit"
                    class="bg-gray-900 text-white px-4 py-2 rounded-xl font-bold text-sm hover:bg-gray-800 transition">
                    Cari
                </button>
                @if (request('search'))
                    <a href="{{ route('admin.instansi.index') }}"
                        class="bg-gray-100 text-gray-600 px-4 py-2 rounded-xl font-bold text-sm hover:bg-gray-200 transition">
                        Reset
                    </a>
                @endif
            </form>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="p-4 text-xs font-bold uppercase text-gray-600">Nama Instansi</th>
                    <th class="p-4 text-xs font-bold uppercase text-gray-600">Alamat</th>
                    <th class="p-4 text-xs font-bold uppercase text-gray-600">Kontak</th>
                    <th class="p-4 text-xs font-bold uppercase text-gray-600">Tipe</th>
                    <th class="p-4 text-xs font-bold uppercase text-gray-600">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($instansis as $i)
                    <tr class="border-b last:border-0 hover:bg-gray-50">
                        <td class="p-4 text-sm font-semibold">{{ $i->nama_instansi }}</td>
                        <td class="p-4 text-sm font-semibold">{{ $i->alamat_instansi }}</td>
                        <td class="p-4 text-sm font-semibold">{{ $i->kontak_instansi }}</td>
                        <td class="p-4 text-sm">
                            <span
                                class="px-3 py-1 rounded-full text-sm font-bold uppercase {{ $i->tipe == 'universitas' ? 'bg-blue-100 text-blue-600' : 'bg-green-100 text-green-600' }}">
                                {{ $i->tipe }}
                            </span>
                        </td>
                        <td class="px-6 p-4">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.instansi.edit', $i->id) }}" class="hover:bg-blue-900 text-white bg-blue-600 hover:text-white px-4 py-2.5 rounded-xl text-[10px] font-black uppercase transition-all shadow-sm border border-red-100 hover:border-red-600">Edit</a>
                                <form action="{{ route('admin.instansi.destroy', $i->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin hapus data ini')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                    class="hover:bg-red-900 text-white bg-red-600 hover:text-white px-4 py-2.5 rounded-xl text-[10px] font-black uppercase transition-all shadow-sm border border-red-100 hover:border-red-600">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
