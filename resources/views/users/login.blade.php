@extends('layout')

@section('title')
Prisijungimas
@endsection

@section('content')
<div class="container content text-center">
  <div class="row">
    <div id="page" class="col-sm-12">
      <h2>Prisijungimas</h2>
    </div>
  </div>
  <div class="row px-2">
    <div class="col-sm-12">
      <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="form-group row">
          <label for="email" class="col-form-label">E-paštas <i class="fa fa-at"></i></label>
          <input
            id="email"
            name="email"
            type="email"
            class="form-control @error('email') is-invalid @enderror"
            value="{{ old('email') ?? '' }}"
            required
            autocomplete="email"
            autofocus>

          @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="form-group row">
          <label for="password" class="col-form-label">Slaptažodis <i class="fa fa-lock"></i></label>
          <input
            id="password"
            name="password"
            type="password"
            class="form-control @error('password') is-invalid @enderror"
            required
            autocomplete="current-password">

          @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        {{-- <div class="form-group row">
          <input
            id="remember"
            name="remember"
            type="checkbox"
            class="form-check-input"
            {{ old('remember') ? 'checked' : '' }}>

          <label for="remember" class="col-form-label">Prisiminti mane</label>
        </div> --}}

        <div class="form-group row">
          <button type="submit" class="btn btn-danger">
            Prisijungti
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
