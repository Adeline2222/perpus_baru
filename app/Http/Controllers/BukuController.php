<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BukuController extends Controller
{
    public function index()
    {
        return view('home', [
            'page' => 'databuku',
            'buku' => Buku::all()
        ]);
    }

    public function store(Request $request)
    {
        if (Auth::user()->role != 'Admin') {
            return back();
        }

        Buku::create($request->all());

        return back();
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role != 'Admin') {
            return back();
        }

        Buku::findOrFail($id)->update($request->all());

        return back();
    }

    public function destroy($id)
    {
        if (Auth::user()->role != 'Admin') {
            return back();
        }

        Buku::findOrFail($id)->delete();

        return back();
    }

    public function laporan()
    {
    $buku = Buku::all();

    return view('laporan_buku', compact('buku'));
    }


}

