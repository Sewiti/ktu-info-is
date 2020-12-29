@extends('layout')

@section('title')
Paslaugos peržiūros langas
@endsection

@section('content')
<div class="container content text-center">
  <div class="card" style="padding: 0.25rem;">
    <div class="row">
      <div class="col">
        <img class="card-img-top" src="{{$uzduotis->url}}" alt="">
        <ul class="list-group list-group-flush border border-light">
          <li class="list-group-item"> Rezervacijos laikas:
            <strong> {{ Carbon\Carbon::parse($uzduotis->pradzios_laikas)->format('Y-m-d') }}</strong></li>
          <li class="list-group-item"> Paskirtas darbuotojas:
            <strong> {{ $darbuotojas->vardas.' '.$darbuotojas->pavarde }}</strong></li>
        </ul>
      </div>
      <div class="col">
        <div class="card-body">
          <h3 class="text-center">{{ $uzduotis->pavadinimas }}</h3>
        </div>
        <h4 class="text-center">Aprašymas</h4>
        <hr>
        <p style="margin-top: 5rem; margin-bottom: 5rem;">{{ $uzduotis->aprasas }}</p>
        <hr>
        </ul>
        <div class="d-flex justify-content-end my-3">
          @if($uzduotis->darbuotojas_id == Auth::id())
          <a href='{{ route('tasks.comms', ['recipientId'=>$uzduotis->vartotojas_id]) }}' class="btn btn-success mr-4">
            Parašyti
          </a>
          @else
          <a href='{{ route('tasks.comms', ['recipientId'=>$darbuotojas->id]) }}' class="btn btn-success mr-4">
            Parašyti
          </a>
          @endif

          <a href='{{ url('paslaugos/redaguoti/'.$uzduotis->id) }}' class="btn btn-primary mr-4">Redaguoti</a>
          <form action="{{ route('tasks.destroy', ['task'=>$uzduotis->id]) }}" method="POST">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-danger mr-4">Ištrinti</button>
          </form>

          <a href='{{ route('tasks.index') }}' class="btn btn-dark mr-4">Atgal</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
