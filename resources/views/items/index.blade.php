@extends('layout')

@section('title')
Prekių sąrašo langas
@endsection

@section('content')
<div class="container content text-center">
    <div class="new_arrivals">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <div class="section_title">
                        <h2>Prekės</h2>
                    </div>
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col text-center">
                    <div class="new_arrivals_sorting">
                        <div class="d-flex justify-content-center">
                            <ul class="arrivals_grid_sorting clearfix button-group filters-button-group">
                                <li class="mx-1 mb-1 grid_sorting_button button d-flex flex-column justify-content-center align-items-center active is-checked" data-filter="*">visos</li>
                                @for ($i = count($categories) / 2 + (count($categories)%2/2); $i < count($categories); $i++) <li class="mx-1 mb-1 grid_sorting_button button d-flex flex-column justify-content-center align-items-center" data-filter=".{{ $categories[$i]-> id }}">{{ $categories[$i]-> pavadinimas }}</li>
                                    @endfor
                            </ul>
                        </div>

                        <div class="d-flex justify-content-center">
                            <ul class="arrivals_grid_sorting clearfix button-group filters-button-group">
                                @for ($i = 0; $i < count($categories) / 2 + (count($categories)%2/2); $i++) <li class="mx-1 mt-1 grid_sorting_button button d-flex flex-column justify-content-center align-items-center" data-filter=".{{ $categories[$i]-> id }}">{{ $categories[$i]-> pavadinimas }}</li>
                                    @endfor
                            </ul>
                        </div>
                    </div>
                    <div class="new_arrivals_sorting" style="margin-top: 0;">

                    </div>
                </div>
            </div>
            @role('Administratorius')
              <div>
                <a class="btn btn-success mt-2 py-2" style="margin: 5px; text-transform: uppercase; font-size: 14px;" href="{{ url('/prekes/sukurti')}}">Pridėti naują prekę</a>
              </div>
            @endrole



            <div class="row">
                <div class="col">
                    <div class="product-grid" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>
                        @foreach($prekes as $preke)
                        <div class="product-item {{ $preke->kategorija}}" style="height: 280px;" >
                            <a href="{{ url('/prekes/'.$preke->id)}}">
                                <div class="product_image mt-2">
                                    <img src="{{ $preke-> pagrindine_nuotrauka }}" alt="" style="height: 80%; width: 80%;">
                                </div>

                                <div class="product_info">
                                    <h6 class="product_name">{{ $preke-> pavadinimas }}</h6>
                                    <div class="product_price">${{ $preke-> kaina }}</div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
