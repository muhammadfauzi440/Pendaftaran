<?php

namespace App\Exports;

use App\Models\Pendaftaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PendaftaranExport implements FromCollection, WithHeadings, WithMapping 
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pendaftaran::with(['user', 'instansi'])->latest()->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Pendaftar',
            'email',
            'Instansi',
            'Kategori',
            'NIM/NISN',
            'Jurusan',
            'Durasi (Bulan)',
            'Mulai Magang',
            'Selesai Magang',
            'Status',
            'Waktu Submit',
        ];
    }

    public function map($p): array
    {
        return [
            $p->id,
            $p->user->name ?? '-',
            $p->user->email ?? '-',
            $p->instansi->nama_instansi ?? '-',
            ucfirst($p->kategori),
            "'" . $p->nim_nisn,
            $p->jurusan,
            $p->durasi_bulan,
            $p->tanggal_mulai->format('d-m-Y'),
            $p->tanggal_selesai->format('d-m-Y'),
            strtoupper($p->status),
            $p->created_at->format('d-m-Y H:i:s'),
        ];
    }
}
