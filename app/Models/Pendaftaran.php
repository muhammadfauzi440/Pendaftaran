<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Instansi;
use App\Models\Dokumen;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Pendaftaran extends Model
{
    protected $guarded = ['id'];
    protected $table = 'pendaftaran';
    protected $fillable = [
        'user_id',
        'instansi_id',
        'kategori',
        'nim_nisn',
        'kelas_semester',
        'asal_instansi',
        'jurusan',
        'tanggal_mulai',
        'tanggal_selesai',
        'durasi_bulan',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'jenis_kelamin',
        'agama',
        'kontak',
        'surat_pengajuan',
        'status',
        'catatan_admin'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'tanggal_lahir' => 'date'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function instansi() 
    {
        return $this->belongsTo(Instansi::class);
    }

    public function dokumen()
    {
        return $this->hasMany(Dokumen::class, 'pendaftaran_id');
    }
}
