<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class GaleriController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {   
        $no = 0;
        $batas = 4;
        $dataGaleri = Galeri::with('albums')->orderBy('id', 'desc')->paginate($batas);
        return view('galeri.index', compact('dataGaleri', 'no'));
    }

    public function create()
    {
        $dataBuku = Buku::all(['id', 'judul']);
        return view('galeri.create', compact('dataBuku'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_galeri' => 'required',
            'keterangan' => 'required',
            'foto' => 'required|image|mimes:jpeg,jpg,png'
        ]);

        $galeri = new Galeri;
        $galeri->nama_galeri = $request->nama_galeri;
        $galeri->keterangan = $request->keterangan;
        $galeri->id_buku = $request->id_buku;

        $foto = $request->foto;
        $namaFile = time().".".$foto->getClientOriginalExtension();
        $path = public_path('thumb/' . $namaFile);
        Image::make($foto)->resize(200,150)->save($path);
        $foto->move('images/', $namaFile);

        $galeri->foto = $namaFile;
        $galeri->save();
        
        return redirect('/galeri')->with('message', 'Data galeri buku berhasil ditambahkan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {   
        $dataBuku = Buku::all(['id', 'judul']);
        $galeri = Galeri::find($id);
        return view('galeri.update', compact('dataBuku', 'galeri')); 
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_galeri' => 'required',
            'keterangan' => 'required'
        ]);

        $path = public_path('thumb/');

        $galeri = Galeri::find($id);
        $galeri->nama_galeri = $request->nama_galeri;
        $galeri->keterangan = $request->keterangan;
        $galeri->id_buku = $request->id_buku;

        if ($request->has('foto'))
        {
            $foto = $request->foto;
            $namaFile = time().".".$foto->getClientOriginalExtension();
            Image::make($foto)->resize(200,150)->save($path . $namaFile);
            $foto->move('images/', $namaFile);

            if (File::exists($path . $galeri->foto))
            {
                File::delete($path . $galeri->foto);
                File::delete('images/' . $galeri->foto);
            }

            $galeri->foto = $namaFile;
        }

        $galeri->save();
        return redirect('/galeri')->with('message', 'Data galeri buku berhasil diupdate');
    }

    public function destroy($id)
    {   
        $path = public_path('thumb/');
        $galeri = Galeri::find($id);
        $galeri->delete();

        if (File::exists($path . $galeri->foto))
        {
            File::delete($path . $galeri->foto);
            File::delete('images/' . $galeri->foto);
        }
        return redirect('/galeri')->with('message', 'Data galeri buku berhasil dihapus');
    }
}
