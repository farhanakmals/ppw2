<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Komentar;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BukuController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $batas = 5;
        $jumlahBuku = Buku::count();
        $dataBuku = Buku::orderBy('id')->paginate($batas);
        $no = $batas * ($dataBuku->currentPage()-1);
        return view('buku.index', compact('dataBuku', 'no', 'jumlahBuku'));
    }

    public function search(Request $request)
    {
        $batas = 5;
        $cari = $request->kata;
        $dataBuku = Buku::where('judul', 'like', '%'.$cari.'%')
                    ->orwhere('judul', 'penulis', "%".$cari."%")
                    ->paginate($batas);
        $no = $batas * ($dataBuku->currentPage()-1);
        $jumlahBuku = Buku::count();
        return view('buku.search', compact('dataBuku', 'no', 'jumlahBuku', 'cari'));
    }

    public function create()
    {
        return view('buku.create');
    }

    public function store(Request $request)
    {   
        $this->validate($request, [
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date'
        ]);

        $buku = new Buku;
        $buku->judul = $request->judul;
        $buku->buku_seo = Str::slug($request->judul, '-');
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->suka = 0;
        $buku->save();
        return redirect('/')->with('message', 'Data berhasil ditambahkan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $buku = Buku::find($id);
        return view('buku.update', compact('buku'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date'
        ]);

        $buku = Buku::find($id);
        $buku->update([
            'judul' => $request->judul,
            'penulis' =>  $request->penulis,
            'harga' => $request->harga,
            'tgl_terbit' => $request->tgl_terbit
        ]);
        return redirect('/')->with('message', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $buku = Buku::find($id);
        $buku->delete();
        return redirect('/')->with('message', 'Data berhasil dihapus');
    }

    public function galeriBuku($bukuSeo) {
        $buku = Buku::where('buku_seo', $bukuSeo)->first();
        $dataGaleri = $buku->photos()->orderBy('id', 'desc')->paginate(6);
        $dataKomentar = $buku->comment()->paginate(10);
        return view('buku.detail-buku', compact('buku', 'dataGaleri', 'dataKomentar'));
    }

    public function likeFoto(Request $request, $id) {
        $buku = Buku::find($id);
        $buku->increment('suka');
        return back();
    }
}
