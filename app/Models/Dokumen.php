<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pendaftaran;
class Dokumen extends Model
{
    protected $table = 'dokumens';
    protected $fillable = [
        'pendaftaran_id',
        'tipe_dokumen',
        'nama_dokumen',
        'file_path'
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }
}
