@extends('layout')

@section('title')
    Prekės redagavimo langas
@endsection

@section('content')
<div class="container content text-center">
    <div class="row">
        <div id="page" class="col-sm-12">
            <h2>Prekės redagavimo langas</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <form action="{{ route('prekes.update', [$item]) }}" method="POST" enctype="multipart/form-data">

                @method('PUT')
                @csrf

                <div class="form-group">
                    <label for="pavadinimas">Pavadinimas</label>
                    <input value="{{ $item->pavadinimas}}" name="pavadinimas" type="text" class="form-control" id="pavadinimas">

                    @error('pavadinimas')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="kategorija">Kategorija</label>
                    <select name="kategorija" type="text" class="form-control" id="kategorija">

                        @foreach ($categories as $kategorija)
                        @if($kategorija->id == $item->kategorija)
                        <option selected="selected" value="{{ $kategorija->id }}">{{ $kategorija->pavadinimas }}</option>
                        @else
                        <option value="{{ $kategorija->id }}">{{ $kategorija->pavadinimas }}</option>
                        @endif
                        @endforeach
                    </select>
                    @error('kategorija')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="aprasas">Aprašymas</label>
                    <input value="{{ $item->aprasas}}" name="aprasas" type="text" class="form-control" id="aprasas">

                    @error('aprasas')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="kaina">Kaina</label>
                    <input value="{{ $item->kaina}}" name="kaina" type="number" step="0.01" class="form-control" id="kaina">

                    @error('kaina')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="statusas">Statusas</label>
                    <select name="statusas" type="text" class="form-control" id="statusas">
                        @foreach ($status as $statusName)
                        @if($statusName->id == $item->statusas)
                        <option selected="selected" value="{{ $statusName->id }}">{{ $statusName->pavadinimas }}</option>
                        @else
                        <option value="{{ $statusName->id }}">{{ $statusName->pavadinimas }}</option>
                        @endif
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
