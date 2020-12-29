@extends('layout')

@section('title')
Paslaugų sąrašo langas
@endsection

@section('content')
<div class="container content text-center">
  <div class="row">
    <div id="page" class="col-sm-12">
      <h2>Rezervacijų sąrašo langas</h2>
    </div>
  </div>
  <div class="row justify-content-center">
    @if(count($uzduotys) > 0 && $uzduotys[0]->id != null)
    @foreach ($uzduotys as $uzduotis)
    {{-- @if ($uzduotis->statusas != 2) --}}
    <div class="col-4 my-3">
      <div class="card">
        <img class="card-img-top" src="{{$uzduotis->url}}" alt="">
        <div class="card-body">
          <h5 class="text-center">{{ $uzduotis->pavadinimas }}</h5>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Laikas:
            <strong>{{ Carbon\Carbon::parse($uzduotis->pradzios_laikas)->format('Y-m-d') }}</strong></li>
        </ul>
        <div class="card-body d-flex justify-content-around">
          <a href='{{ route('tasks.show', ["task" => $uzduotis->id]) }}' class="btn btn-primary">Peržiūrėti</a>
        </div>
      </div>
    </div>
    {{-- @endif --}}
    @endforeach
    @else
    Paslaugų nėra.
    @endif
  </div>
</div>
@endsection
