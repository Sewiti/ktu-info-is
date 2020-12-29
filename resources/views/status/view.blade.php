@extends('layout')

@section('title')
  Būsenos sekimas
@endsection

@section('content')
  <div class="container single_product_container">
    <div class="row">
      <div class="col-sm-12 mt-5">
        <h4 class="text-sm-center">Sekti savo užsakymo būseną</h4>
        <p>Įveskite savo užsakymo kodą, kurį gavote el. paštu ir stebėkite jūsų užsakymo eigą</p>
        @if(session('error'))
          <div class="row">
            <div class="col-lg-12">
              <div class="alert alert-danger"> {{ session('error') }}</div>
            </div>
          </div>
        @endif
        <form method="post" action="{{ action('StatusController@show') }}">
          @csrf
          <div class="form-group row">
            <input name="kodas" placeholder="Kodas" type="text" class="form-control">
          </div>
          <div class="form-group row">
            <input type="submit" class="form-control" value="Ieškoti">
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
