<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';

    protected $fillable = [
        'kode_buku',
        'judul_buku',
        'penulis',
        'stok'
    ];

    public function peminjaman()
{
    return $this->hasMany(Peminjaman::class);
}
}