@extends('layout')

@section('title')
Pagrindinis
@endsection

@section('content')
<div class="container content text-center main-bg">
  <div class="row">
    <div id="page" class="col-sm-12">
      <h1>
        Sveiki atvykę į
      </h1>
      <h1>
        <span class="text-uppercase">Elektronikos</span>
        <span class="text-uppercase text-danger">taisyklą!</span>
      </h1>


    </div>
  </div>

  {{-- @guest
  <div class="row">
    <div class="col-sm-12">
      <a class="btn btn-info" style="margin: 5px;" href="{{ route('register') }}">Registracija</a>
      <a class="btn btn-info" style="margin: 5px;" href="{{ route('login') }}">Prisijungimas</a>
    </div>
  </div>
  @endguest
  @auth
  <div class="row">
    <div class="col-sm-12">
      @role('Administratorius')
      <a class="btn btn-dark" style="margin: 5px;" href=" {{ route('users.index') }}">
        Vartotojų sąrašas
      </a>
      @else
      <span class="d-inline-block" data-toggle="tooltip" data-placement="top" title="Tik administratoriams">
        <a class="btn btn-dark disabled" style="margin: 5px;" href="#">
          Vartotojų sąrašas
        </a>
      </span>
      @endrole

      <a class="btn btn-dark" style="margin: 5px;" href="{{ route('users.show', ['userId'=>Auth::id()]) }}">
        Paskyros peržiūra
      </a>
      <a class="btn btn-dark" style="margin: 5px;" href="{{ route('users.edit', ['userId'=>Auth::id()]) }}">
        Paskyros redagavimas
      </a>
      <a class="btn btn-dark" style="margin: 5px;" href="{{ route('users.invite') }}">
        Pakvietimai
      </a>
    </div>
  </div>
  @endauth

  <div class="row">
    <div class="col-sm-12">
      <a class="btn btn-success" style="margin: 5px;" href="{{ url('/kalendorius')}}">Kalendorius</a>
      <a class="btn btn-success" style="margin: 5px;" href="{{ url('/paslaugos/sukurti')}}">Rezervacijos kūrimo
        langas</a>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <a class="btn btn-success" style="margin: 5px;" href="{{ url('/paslaugos/sekti')}}">Paslaugos būsenos sekimo
        langas</a>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <a class="btn btn-danger" style="margin: 5px;" href="{{ url('/paslaugos')}}">Rezervacijų sąrašo langas</a>
      <a class="btn btn-danger" style="margin: 5px;" href="{{ url('/paslaugos/1')}}">Rezervacijos peržiūros
        langas</a>
      <a class="btn btn-danger" style="margin: 5px;" href="{{ url('/paslaugos/1/redaguoti')}}">Rezervacijos
        redagavimo langas</a>
      <a class="btn btn-danger" style="margin: 5px;" href="{{ url('/paslaugos/comms/1')}}">Susirašinėjimo
        skiltis</a>
      <a class="btn btn-danger" style="margin: 5px;" href="{{ url('/paslaugos/salinti/1')}}">Rezervacijos šalinimo
        langas</a>
    </div>
  </div> --}}

</div>


@endsection

@section('style')
<style>
body {
  background-image: url('images/electronics-bright.jpg');
  height: 100vh;
  background-size: cover;
  background-repeat: no-repeat;
}
</style>
@endsection
