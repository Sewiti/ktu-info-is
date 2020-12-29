@extends('layout')

@section('title')
Prekės kūrimo langas
@endsection

@section('content')
<div class="container content text-center">
    <div class="row">
        <div id="page" class="col-sm-12">
            <h2>Prekės kūrimo langas</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <form action="{{ route('prekes.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="form-group">
                    <label for="pavadinimas">Pavadinimas</label>
                    <input name="pavadinimas" type="text" class="form-control" id="pavadinimas">

                    @error('pavadinimas')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="kategorija">Kategorija</label>
                    <select name="kategorija" type="text" class="form-control" id="kategorija">

                        @foreach ($categories as $kategorija)
                        <option value="{{ $kategorija->id }}">{{ $kategorija->pavadinimas }}</option>
                        @endforeach
                    </select>
                    @error('kategorija')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="aprasas">Aprašymas</label>
                    <input name="aprasas" type="text" class="form-control" id="aprasas">

                    @error('aprasas')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="kaina">Kaina</label>
                    <input name="kaina" type="number" step="0.01" class="form-control" id="kaina">

                    @error('kaina')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="pagrindine_nuotrauka">Pagrindinės nuotraukos nuoroda</label>
                    <input name="pagrindine_nuotrauka" type="file" class="form-control" id="pagrindine_nuotrauka">

                    @error('pagrindine_nuotrauka')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="statusas">Statusas</label>
                    <select name="statusas" type="text" class="form-control" id="statusas">
                        @foreach ($status as $statusasName)
                        <option value="{{ $statusasName->id }}">{{ $statusasName->pavadinimas }}</option>
                        @endforeach
                    </select>

                    @error('statusas')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-dark">Sukurti</button>

            </form>
        </div>
    </div>
</div>
@endsection
