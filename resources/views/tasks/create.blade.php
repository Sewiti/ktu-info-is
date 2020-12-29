@extends('layout')

@section('title')
Paslaugos kūrimo langas
@endsection

@section('content')
<div class="container content text-center">
  <div class="row">
    <div id="page" class="col-sm-12">
      <h2>Paslaugos kūrimo langas</h2>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <form action="{{ route('tasks.store', ["employee" => $employee]) }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="form-group">
          <label for="name">Pavadinimas</label>
          <input name="name" type="text" class="form-control" id="name" required>

          @error('name')
          <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>

        <div class="form-group">
          <label for="description">Aprašymas</label>
          <input name="description" type="text" class="form-control" id="description" required>

          @error('description')
          <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>

        <div class="form-group">
          <label for="main_image">Problemos iliustracija</label>
          <input name="main_image" type="file" class="form-control" id="main_image" required>

          @error('main_image')
          <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>

        <div class="form-group">
          <label for="employee">Priskirtas darbuotojas</label>
          <input name="employee" type="text" class="form-control" id="employee" readonly
            value="{{ $employee->vardas }} {{ $employee->pavarde }}">

          @error('employee')
          <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>

        <div class="form-group">
          <label for="task_date">Rezervacijos laikas</label>
          <input name="task_date" type="text" class="form-control" id="task_date" readonly value="{{ $date }}">

          @error('task_date')
          <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>

        <button type="submit" class="btn btn-dark">Sukurti</button>

      </form>



      {{-- <a class="btn btn-warning" style="margin: 5px;" href="{{ url('/') }}">Pagrindinis</a>
      <a class="btn btn-danger" style="margin: 5px;" href="{{ url('/kalendorius') }}">Kalendorius</a>
      <a class="btn btn-danger" style="margin: 5px;" href="{{ url('/paslaugos/sukurti/uzsakymas') }}">Užsakymo
        peržiūra</a> --}}
    </div>
  </div>
</div>
@endsection
