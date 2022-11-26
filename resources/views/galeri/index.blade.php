@extends('layouts.app')
@section('content')
<section class="container-xl my-4">
  <div class="d-flex justify-content-between">
    <h3>Galeri Buku</h3>
    <a href="{{ route('galeri.create') }}"><button class="btn btn-primary">Tambah</button></a>
  </div>
  @if (Session::has('message'))
  <div class="alert alert-success mt-2">{{ Session::get('message') }}</div>
  @endif
  <table class="table table-hover mt-3">
    <thead>
    <tr class="table-light">
      <th scope="col">No</th>
      <th scope="col">Nama</th>
      <th scope="col">Judul Buku</th>
      <th scope="col">Foto</th>
      <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach ($dataGaleri as $galeri)
    <tr>
      <td>{{ ++$no }}</td>
      <td>{{ $galeri->nama_galeri }}</td>
      <td>{{ $galeri->albums->judul }}</td>
      <td><img src="{{ asset('thumb/'.$galeri->foto) }}" class="img-fluid"></td>
      <td>
      <div class="d-flex gap-2">
        <a href="{{ route('galeri.edit', $galeri->id )}}"><button class="btn btn-outline-primary">Update</button></a>
        <form method="POST" action="{{ route('galeri.destroy', $galeri->id) }}">
        @csrf
        <button class="btn btn btn-outline-primary" onclick="return confirm('Yakin mau dihapus?')">Hapus</button>
        </form>
      </div>
      </td>
    </tr>
    @endforeach
    </tbody>
  </table>
  <div>{{ $dataGaleri->links() }}</div>
  </section>
@endsection