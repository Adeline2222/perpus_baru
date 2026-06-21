<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $fillable = [
        'anggota_id',
        'buku_id',
        'jam_masuk',
        'jam_keluar',
        'status_kartu',
        'status'
    ];

    public function anggota()
{
    return $this->belongsTo(Anggota::class, 'anggota_id', 'nis');
}

public function buku()
{
    return $this->belongsTo(Buku::class, 'buku_id', 'id');
}


}