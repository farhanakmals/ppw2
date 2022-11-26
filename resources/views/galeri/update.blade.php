@extends('layouts.app')

@section('content')
<div class="container-xl my-4">
  <h3>Edit Galeri</h3>
  @if (count($errors) > 0)
    <ul class="alert alert-danger">
      @foreach ($errors->all() as $error)
        <li class="list-group-item">{{ $error }}</li>
      @endforeach
    </ul>
  @endif
  <form class="mt-3" method="POST" enctype="multipart/form-data" action="{{ route('galeri.update', $galeri->id) }}">
    @csrf
    <div class="mb-3">
      <label for="nama_galeri" class="form-label">Nama Galeri</label>
      <input type="text" class="form-control" id="nama_galeri" name="nama_galeri" value="{{ $galeri->nama_galeri }}">
    </div>
    <div class="mb-3">
      <label for="id_buku" class="form-label">Buku</label>
      <select name="id_buku" id="id_buku" class="form-control">
        @foreach($dataBuku as $buku)
        <option value="{{ $buku->id }}"{{ $buku->id==$galeri->id_buku? ' selected':'' }}>{{ $buku->judul }}</option>
        @endforeach
      </select>
    </div>
    <div class="mb-3">
      <label for="keterangan" class="form-label">Keterangan</label>
      <textarea class="form-control" id="keterangan" name="keterangan">{{ $galeri->keterangan }}</textarea>
    </div>
    <div class="mb-4">
      <label for="foto" class="form-label">Foto</label>
      <img src="{{ asset('thumb/'.$galeri->foto) }}" alt="" class="img-fluid d-block mb-4">
      <input type="file" class="form-control" id="foto" name="foto">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="/galeri" class="btn btn-outline-primary">Batal</a>
@endsection