<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $pendaftarans = Pendaftaran::with(['user', 'instansi'])->latest()->get();

        return view('admin.pendaftaran.index', compact('pendaftarans'));
    }

    public function show($id)
    {
        $pendaftaran = Pendaftaran::with(['user', 'instansi', 'dokumen'])->findOrFail($id);

        return view('admin.pendaftaran.show', compact('pendaftaran'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diterima,ditolak',
            'catatan_admin' => 'required|string|min:10|max:300',
        ],
        [
            'catatan_admin.required' => 'Anda harus memberikan alasan atau catatan untuk pendaftar.',
            'catatan_admin.min' => 'Catatan terlalu singkat',
            'catatan_admin.max' => 'Catatan terlalu panjang',
        ]);


        try {
            DB::beginTransaction();

            $pendaftaran = Pendaftaran::findOrFail($id);
            $pendaftaran->update([
                'status' => $request->status,
                'catatan_admin' => $request->catatan_admin
            ]);

            DB::commit();

            $pesan = $request->status == 'diterima'
            ? 'Pendaftaran berhasil diterima.'
            : 'Pendaftaran telah ditolak';

            return redirect()->route('admin.pendaftaran.index')->with('success', $pesan);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
