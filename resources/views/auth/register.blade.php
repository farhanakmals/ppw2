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
            <h1 class="card-title text-center mb-4 fw-semibold fs-3">Register</h1>
            <form method="POST" action="{{ route('register') }}">
              @csrf
              <div class="mb-3">
                <label for="name" class="form-label">{{ __('Name') }}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="mb-3">
                <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
              </div>
              <div class="mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="level" id="level1" value="user" checked>
                  <label class="form-check-label" for="level1">
                    User
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="level" id="level2" value="admin">
                  <label class="form-check-label" for="level2">
                    Admin
                  </label>
                </div>
              </div>
              <button type="submit" class="btn btn-primary w-100">
                {{ __('Register') }}
            </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
