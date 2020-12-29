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
                <a class="btn btn-warning" style="margin: 5px;" href="{{ url('/') }}">Pagrindinis</a>
                <a class="btn btn-danger" style="margin: 5px;" href="{{ url('/paslaugos/1') }}">Paslaugos peržiūros langas</a>
            </div>
        </div>
    </div>
@endsection
