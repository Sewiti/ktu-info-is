@extends('layout')

@section('title')
    Užsakymo peržiūros langas
@endsection

@section('content')
    <div class="container content text-center">
        <div class="row">
            <div id="page" class="col-sm-12">
                <h2>Užsakymo peržiūros langas</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <a class="btn btn-warning" style="margin: 5px;" href="{{ url('/') }}">Pagrindinis</a>
                <a class="btn btn-success" style="margin: 5px;" href="{{ url('/paslaugos/sukurti') }}">Paslaugos kūrimo langas</a>
                <a class="btn btn-success" style="margin: 5px;" href="{{ url('/paslaugos/sukurti/uzsakymas/apmoketi') }}">Paslaugų apmokėjimo langas</a>
            </div>
        </div>
    </div>
@endsection
