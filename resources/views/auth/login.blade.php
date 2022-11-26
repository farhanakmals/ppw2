@extends('layouts.app')

@push('styles')
<style>
  .card-img-left {
    width: 45%;
    /* Link to your background image using in the property below! */
    background: scroll center url('img/book.jfif');
    background-size: cover;
  }
</style> 
@endpush

@section('content')
<div class="container">
  <div class="row h-100 d-flex justify-content-center align-items-center">
    <div class="col-lg-10 col-xl-9 mx-auto">
      <div class="card flex-row my-4 overflow-hidden h-100">
        <div class="card-img-left d-none d-md-flex">
          <!-- Background image for card set in CSS! -->
        </div>
        <div class="card-body p-4 p-sm-5">
          <h1 class="card-title text-center mb-4 fw-semibold fs-3">Login</h1>
          <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email address</label>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

              @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

              @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary w-100">
              {{ __('Login') }}
            </button>
            @if (Route::has('password.request'))
                <a class="d-block mt-3" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
