<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PendaftaranExport;
use App\Http\Controllers\Controller;
use App\Models\Instansi;
use App\Models\Pendaftaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

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

    public function edit($id)
    {
        $pendaftaran = Pendaftaran::with(['user', 'instansi', 'dokumen'])->findOrFail($id);
        $instansis = Instansi::all();

        return view('admin.pendaftaran.edit', compact('pendaftaran', 'instansis'));
    }

    public function update(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        $request->validate([
            'nim_nisn' => 'required|numeric',
            'instansi_id' => 'required|exists:instansis,id',
            'kategori' => 'required|in:siswa,mahasiswa',
            'jurusan' => 'required|string|max:100',
            'kelas_semester' => 'required|string|max:50',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'agama' => 'required|string|max:50',
            'kontak' => 'required|string|max:20',
            'alamat' => 'required|string|max:500',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'durasi_bulan' => 'required|integer|min:1',
        ]);

        $pendaftaran->update($request->all());

        return redirect()->route('admin.pendaftaran.index')->with('success', 'Data pendaftaran berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pendaftaran = Pendaftaran::with('dokumen')->findOrFail($id);

        if ($pendaftaran->dokumen->isNotEmpty()) {
            foreach ($pendaftaran->dokumen as $dok) {
                if (Storage::disk('public')->exists($dok->file_path)) {
                    Storage::disk('public')->delete($dok->file_path);
                }
            }
        }

        $pendaftaran->delete();

        return redirect()->route('admin.pendaftaran.index')
            ->with('success', 'Data pendaftaran berhasil dihapus');
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
                'catatan_admin' => $request->catatan_admin,
            ]);

            DB::commit();

            $pesan = $request->status == 'diterima'
            ? 'Pendaftaran berhasil diterima.'
            : 'Pendaftaran telah ditolak';

            return redirect()->route('admin.pendaftaran.index')->with('success', $pesan);
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }

    public function exportPdf()
    {
        $pendaftarans = Pendaftaran::with(['user', 'instansi'])->latest()->get();

        $pdf = Pdf::loadView('admin.pendaftaran.pdf', compact('pendaftarans'));

        return $pdf->setPaper('a4', 'landscape')->download('laporan-pendaftaran.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new PendaftaranExport, 'laporan-pendaftaran-'.date('Y-m-d').'.xlsx');
    }
}
