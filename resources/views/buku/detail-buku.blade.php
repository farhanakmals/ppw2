@extends('layouts.app')
@section('content')
<section class="container-xl my-4">
  <div class="d-flex justify-content-between">
    <h3 class="mb-3">{{ $buku->judul }}</h3>
    <a href="/"><button class="btn btn-primary">Kembali</button></a>
  </div>
  <div class="row">
    @foreach ($dataGaleri as $galeri)
    <div class="col-3">
      <a href="{{ asset('images/'.$galeri->foto) }}" data-lightbox="image-1" data-title="{{ $galeri->keterangan }}">
        <img src="{{ asset('images/'.$galeri->foto) }}" class="img-fluid"></a>
    </div>
    @endforeach
  </div>
  <div>{{ $dataGaleri->links() }}</div>
</section>
@endsection

@push('styles')
<link href="{{ '/css/lightbox.min.css' }}" rel="stylesheet">
<script src="{{ '/js/lightbox-plus-jquery.min.js' }}"></script>
@endpush