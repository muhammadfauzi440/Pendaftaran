<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pendaftaran;
class Instansi extends Model
{
    protected $fillable = [
        'nama_instansi',
        'alamat_instansi',
        'kontak_instansi',
        'tipe'
    ];

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class);
    }
}
