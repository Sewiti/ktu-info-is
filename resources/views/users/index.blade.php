@extends('layout')

@section('title')
  Vartotojų sąrašas
@endsection

@section('content')
<div class="container content text-center">
  <div class="row">
    <div id="page" class="col-sm-12">
      <h2>Vartotojų sąrašas</h2>
    </div>
  </div>
  <div class="row px-2">
    @foreach ($users as $user)
    <div class="col-4 my-3">
      <div class="card">
        <div class="card-body">
          <h4 class="text-center">
            <span>{{ $user->vardas }}</span>
            <span class="text-danger">{{ $user->pavarde }}</span>
          </h4>
          <h6 class="text-secondary text-center">
            @switch($user->vartotojo_tipas)
              @case(1)
                <i class="fa fa-user"></i>
                Klientas
                @break
              @case(2)
                <i class="fa fa-briefcase"></i>
                Darbuotojas
                @break
              @case(3)
                <i class="fa fa-shield"></i>
                Administratorius
                @break
              @default
                <i class="fa fa-user"></i>
                {{ $user->vartotojo_tipas }}
            @endswitch
          </h6>
          <a href='{{ route('users.show', ['userId' => $user->id]) }}' class="btn btn-dark mt-2">
            Peržiūrėti
          </a>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection
