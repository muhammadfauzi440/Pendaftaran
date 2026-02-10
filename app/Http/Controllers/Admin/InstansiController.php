<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Instansi;

class InstansiController extends Controller
{
    public function index()
    {
        $instansis = Instansi::latest()->get();
        return view('admin.instansi.index', compact('instansis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_instansi' => 'required|unique:instansis',
            'alamat_instansi' => 'required',
            'kontak_instansi' => 'required',
            'tipe' => 'required|in:sekolah,universitas'
        ]);

        Instansi::create($request->all());
        return redirect()->route('admin.instansi.index')->with('success', 'Instansi berhasil ditambahkan');
    }

    public function destroy(Instansi $instansi)
    {
        $instansi->delete();
        return redirect()->route('admin.instansi.index')->with('success', 'Instansi berhasil dihapus');
    }
}
