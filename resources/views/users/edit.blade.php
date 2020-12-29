@extends('layout')

@section('title')
Paskyros redagavimas
@endsection

@section('content')
<div class="container content text-center">
  <div class="row">
    <div id="page" class="col-sm-12">
      <h2>Paskyros redagavimas</h2>
    </div>
  </div>
  <div class="row px-2">
    <div class="col-sm-12">
      <form action="{{ route('users.update', ['userId'=>$user->id]) }}" method="POST">
        @csrf
        @method('PUT')
        @include('users.form', ['edit'=>true])
      </form>
    </div>
  </div>
</div>
@endsection
