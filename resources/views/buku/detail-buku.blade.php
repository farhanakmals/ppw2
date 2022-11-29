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
<section class="container-xl">
  <form action="{{ route('komentar.store', $buku->id) }}" method="POST">
    @csrf
    <div class="my-3">
      <label for="komentar" class="form-label">Komentar</label>
      <textarea class="form-control @error('komentar') is-invalid @enderror" id="komentar" name="komentar" rows="3"></textarea>
      @error('komentar')<div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>@enderror
    </div>
    <button type="submit" class="btn btn-primary">Posting</button>
  </form>
</section>
<section class="container-xl mb-3">
  @foreach($dataKomentar as $komentar)
  <div class="card mt-3">
    <div class="card-body">
      <h5 class="card-title">{{ $komentar->user->name }}</h5>
      <p class="card-text">{{ $komentar->comment }}</p>
    </div>
  </div>
  @endforeach
</section>
@endsection

@push('styles')
<link href="{{ '/css/lightbox.min.css' }}" rel="stylesheet">
<script src="{{ '/js/lightbox-plus-jquery.min.js' }}"></script>
@endpush