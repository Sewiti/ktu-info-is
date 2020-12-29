@extends('layout')

@section('title')
Vartotojo peržiūra
@endsection

@section('content')
<div class="container content">
  <div class="row">
    <div class="col-sm-12">
      <h2 class="text-center">
        <span>{{ $user->vardas }}</span>
        <span class="text-danger">{{ $user->pavarde }}</span>
      </h2>
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

      <h4 class="mt-4">E-paštas <i class="fa fa-at"></i></h4>
      <span>{{ $user->email }}</span>

      <h4 class="mt-4">Adresas <i class="fa fa-map-marker"></i></h4>
      <span>{{ $user->adresas ?? '-' }}</span>

      <h4 class="mt-4">Miestas <i class="fa fa-building"></i></h4>
      <span>{{ $user->miestas ?? '-' }}</span>

      <h4 class="mt-4">Šalis <i class="fa fa-globe"></i></h4>
      <span> {{ $user->salis ?? '-' }}</span>

      <h4 class="mt-4">Pašto kodas <i class="fa fa-envelope"></i></h4>
      <span> {{ $user->pasto_kodas ?? '-' }}</span>

      <div class="mt-4">
        @if(Auth::id() == $user->id)
          <a href="{{ route('users.edit', ['userId'=>$user->id]) }}" class="btn btn-dark">
            Redaguoti
          </a>
        @endif

        @role('Administratorius')
          <button class="btn btn-dark" data-toggle="modal" data-target="#editModal">
            Keisti rolę
          </button>

          <!-- Modal -->
          <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <form action="{{ route('users.update.role', ['userId' => $user->id]) }}" method="POST">
                  @method('PUT')
                  @csrf

                  <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Pakeisti rolę</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <label for="vartotojo_tipas" class="form-label">Rolė</label>
                    <select
                      id="vartotojo_tipas"
                      name="vartotojo_tipas"
                      class="form-control">

                      @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {!! $user->vartotojo_tipas == $role->id ? "selected" : "" !!}>
                          {{ $role->pavadinimas }}
                        </option>
                      @endforeach
                    </select>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Uždaryti</button>
                    <button type="submit" class="btn btn-danger">Išsaugoti</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        @endrole

        @if(Auth::id() == $user->id)
          <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
            Ištrinti
          </button>

          <a class="btn btn-primary" href="{{ route('users.invite') }}">
            Pakvietimai
          </a>

          <!-- Modal -->
          <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="deleteModalLabel">Ištrinti paskyrą</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Ar tikrai norite ištrinti savo paskyrą?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-dark" data-dismiss="modal">Uždaryti</button>

                  <form action="{{ route('users.destroy', ['userId'=>$user->id]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Ištrinti</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
