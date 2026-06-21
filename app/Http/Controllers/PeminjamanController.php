<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Anggota;
use App\Models\Buku;

class PeminjamanController extends Controller
{
    // HALAMAN PEMINJAMAN
    public function index()
    {
        return view('home', [
            'page' => 'peminjaman',
            'peminjaman' => Peminjaman::with(['anggota','buku'])->latest()->get(),
            'anggota' => Anggota::all(),
            'buku' => Buku::all(),
        ]);
    }

    // LAPORAN PEMINJAMAN
    public function laporan()
    {
        $data = Peminjaman::with(['anggota','buku'])
            ->latest()
            ->get();

        return view('laporan_peminjaman', compact('data'));
    }

    // SIMPAN DATA
    public function store(Request $request)
    {
        $anggotaText = $request->anggota_input;

        $nis = trim(explode('-', $anggotaText)[0]);

        $anggota = Anggota::where('nis', $nis)->first();

        if (!$anggota) {
            return back()->with('error', 'Anggota tidak ditemukan');
        }

        $bukuId = null;

        if (!empty($request->buku_input)) {

            $buku = Buku::where('judul_buku', $request->buku_input)->first();

            if ($buku) {

                $bukuId = $buku->id;

                if ($buku->stok > 0) {
                    $buku->decrement('stok');
                }
            }
        }

        Peminjaman::create([
            'anggota_id' => $anggota->nis,
            'buku_id' => $bukuId,
            'jam_masuk' => now(),
            'jam_keluar' => null,
            'status_kartu' => 'Ditahan',
            'status' => 'Masuk'
        ]);

        return back()->with('success', 'Data berhasil ditambahkan');
    }

    // EDIT DATA
    public function update(Request $request, $id)
    {
        $data = Peminjaman::findOrFail($id);

        $data->update([
            'buku_id' => $request->buku_id
        ]);

        return back()->with('success', 'Data berhasil diubah');
    }

    // PENGUNJUNG KELUAR
    public function keluar($id)
    {
        $data = Peminjaman::findOrFail($id);

        $data->update([
            'jam_keluar' => now(),
            'status' => 'Selesai',
            'status_kartu' => 'Dikembalikan'
        ]);

        if ($data->buku_id) {
            Buku::find($data->buku_id)?->increment('stok');
        }

        return back()->with('success', 'Pengunjung berhasil keluar');
    }

    // HAPUS DATA
    public function destroy($id)
    {
        $data = Peminjaman::findOrFail($id);

        if ($data->buku_id && $data->status == 'Masuk') {
            Buku::find($data->buku_id)?->increment('stok');
        }

        $data->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}