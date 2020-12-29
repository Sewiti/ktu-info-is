@extends('layout')

@section('title')
    Kontaktai
@endsection

@section('content')
    <div class="container content text-center">
        <div class="row">
            <div id="page" class="col-sm-12">
                <h2>Kontaktai</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <a class="btn btn-warning" style="margin: 5px;" href="{{ url('/') }}">Pagrindinis</a>
            </div>
        </div>
    </div>
@endsection
