@extends('layouts.app')

@section('content')
<div class="container-xl my-4">
  <h3>Edit Buku</h3>
  @if (count($errors) > 0)
  <ul class="alert alert-danger">
    @foreach ($errors->all() as $error)
      <li class="list-group-item">{{ $error }}</li>
    @endforeach
  </ul>
  @endif
  <form class="mt-3" method="POST" action="{{ route('buku.update', $buku->id) }}">
    @csrf
    <div class="mb-3">
      <label for="judul" class="form-label">Judul</label>
      <input type="text" class="form-control" id="judul" name="judul" value="{{ $buku->judul }}">
    </div>
    <div class="mb-3">
      <label for="penulis" class="form-label">Penulis</label>
      <input type="text" class="form-control" id="penulis" name="penulis" value="{{ $buku->penulis }}">
    </div>
    <div class="mb-3">
      <label for="harga" class="form-label">Harga</label>
      <input type="text" class="form-control" id="harga" name="harga" value="{{ $buku->harga }}">
    </div>
    <div class="mb-3">
      <label for="tgl_terbit" class="form-label">Tgl. Terbit</label>
      <input type="date" class="date form-control" id="tgl_terbit" name="tgl_terbit" value="{{ $buku->tgl_terbit->format('Y-m-d') }}">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="/" class="btn btn-outline-primary">Batal</a>
  </form>
  <script type="text/javascript">
    $('.date').datepicker({
      format: 'yyyy/mm//dd'
      autoclose: 'true'
    });
  </script>
</div>
@endsection