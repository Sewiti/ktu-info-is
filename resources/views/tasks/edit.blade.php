@extends('layout')

@section('title')
Paslaugos redagavimo langas
@endsection

@section('content')
<div class="container content text-center">
  <div class="row">
    <div id="page" class="col-sm-12">
      <h2>Paslaugos redagavimo langas</h2>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <form
        action="{{ route('tasks.update', ["task" => $uzduotis->id, "uzduotis" => $uzduotis, "rezervacija" => $rezervacija, "nuotrauka" => $nuotrauka]) }}"
        method="POST" enctype="multipart/form-data">

        @method('PUT')
        @csrf
        @role('Administratorius' , 'Klientas')
        <div class="form-group">
          <label for="pavadinimas">Pavadinimas</label>
          <input value="{{ $uzduotis->pavadinimas}}" name="pavadinimas" type="text" class="form-control"
            id="pavadinimas" required>

          @error('pavadinimas')
          <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>

        <div class="form-group">
          <label for="aprasas">Aprašymas</label>
          <input value="{{ $uzduotis->aprasas}}" name="aprasas" type="text" class="form-control" id="aprasas" required>

          @error('aprasas')
          <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
        @endrole

        @role('Administratorius', 'Darbuotojas')
        <div class="form-group">
          <label for="statusas">Statusas</label>

          <select class="form-control" name="statusas" id="statusas">
            <option value={{ $uzduotis->statusas }} selected disabled hidden>
              {{$uzduotis->statusas == 4 ? 'Baigta' : 'Aktyvus'}}</option>
            <option value={{4}}>Baigta</option>
            <option value={{5}}>Aktyvus</option>
          </select>

          @error('statusas')
          <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
        @endrole

        <button type="submit" class="btn btn-dark">Redaguoti</button>

      </form>
    </div>
  </div>
</div>
@endsection
