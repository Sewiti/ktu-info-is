@extends('layout')

@section('title')
Registracija
@endsection

@section('content')
<div class="container content text-center">
  <div class="row">
    <div id="page" class="col-sm-12">
      <h2>Registracija</h2>
    </div>
  </div>
  <div class="row px-2">
    <div class="col-sm-12">
      <form action="{{ route('register') }}" method="POST">
        @csrf
        @include('users.form')
      </form>
    </div>
  </div>
</div>
@endsection
