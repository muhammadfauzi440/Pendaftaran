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
                <input class="border p-3 rounded-xl text-sm" type="text" name="nama_instansi" placeholder="Nama Instansi" required>
                <input class="border p-3 rounded-xl text-sm" type="text" name="alamat_instansi" placeholder="Alamat Instansi" required>
                <input class="border p-3 rounded-xl text-sm" type="text" name="kontak_instansi" placeholder="Kontak Instansi" required>
                <select class="border p-3 rounded-xl text-sm" name="tipe" id="tipe" required>
                    <option value="" disabled selected>Pilih Tipe Instansi</option>
                    <option value="sekolah">Sekolah</option>
                    <option value="universitas">Universitas</option>
                </select>

                <button type="submit" class="mt-4 bg-red-600 text-white px-6 py-2 rounded-xl font-bold text-sm">Simpan</button>
            </div>
        </form>
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
                            <span class="px-3 py-1 rounded-full text-sm font-bold uppercase {{ $i->tipe == 'universitas' ? 'bg-blue-100 text-blue-600' : 'bg-green-100 text-green-600' }}">
                                {{ $i->tipe }}
                            </span>
                        </td>
                        <td class="p-4">
                            <form action="{{ route('admin.instansi.destroy', $i->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus data ini')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 rounded-2xl text-sm font-bold text-white px-2 py-1 uppercase">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection