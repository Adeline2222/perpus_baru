<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function beranda()
{
    return view('home',[
        'page' => 'beranda',
        'totalAnggota' => Anggota::count(),
        'totalBuku' => Buku::count(),
        'totalPeminjaman' => Peminjaman::count(),
        'totalAktif' => Peminjaman::where('status','Aktif')->count(),
    ]);
}

    public function index()
    {
        return view('home',[
            'page' => 'dataanggota',
            'anggota' => Anggota::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:anggota,nis',
            'nama' => 'required',
            'kelas' => 'required',
        ]);

        Anggota::create($request->all());

        return back()->with('success','Berhasil tambah anggota');
    }

    public function update(Request $request, $id)
    {
        $anggota = Anggota::findOrFail($id);

        $anggota->update([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
        ]);

        return back()->with('success', 'Berhasil update anggota');
    }

    public function laporan()
    {
        $anggota = Anggota::orderBy('nama')->get();

        return view('laporan_anggota', compact('anggota'));
    }
    public function destroy($id)
{
    $anggota = Anggota::findOrFail($id);
    $anggota->delete();

    return back()->with('success', 'Berhasil hapus anggota');
}



}