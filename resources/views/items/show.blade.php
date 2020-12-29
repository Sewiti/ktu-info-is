@extends('layout')

@section('title')
Prekės peržiūros langas
@endsection

@section('content')
<div class="container single_product_container">
    <div class="row">
        <div class="col">
            <div class="breadcrumbs d-flex flex-row align-items-center">
                <ul>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-7">
            <div class="single_product_pics">
                <div class="row">
                    <div class="col-lg-3 thumbnails_col order-lg-1 order-2">
                        <div class="single_product_thumbnails">
                            <ul>
                                <li class="active"><img src="{{$item->pagrindine_nuotrauka}}" alt="" data-image="{{$item->pagrindine_nuotrauka}}"></li>
                                @forelse ($images as $image)
                                <li><img src="{{ $image->url }}" alt="" data-image="{{$image->url}}"></li>
                                @empty

                                @endforelse
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9 image_col order-lg-2 order-1">
                        <div class="single_product_image">
                            <div class="single_product_image_background" style="background-image:url({{$item->pagrindine_nuotrauka}})"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="product_details">
                <div class="product_details_title">
                    <h2>{{$item->pavadinimas}}</h2>
                    <p>{{$item->aprasas}}</p>
                </div>

                <div class="product_price">${{$item->kaina}}</div>

                <div class="quantity d-flex flex-column flex-sm-row align-items-sm-center">
                    <form method="post" id="addToCart" action="{{ action('CartController@store', [$item->id]) }}">
                        @csrf
                        <div class="mt-2 mb-3 d-flex flex-column flex-sm-row align-items-sm-center">
                          <input class="white_input" type="number" required placeholder="Kiekis" min="1" id="quantity_value" name="quantity" value="{{ old('quantity') ? old('quantity') : '1' }}">
                          <div class="ml-3 red_button add_to_cart_button">
                            <input form="addToCart" class="red_button add_to_cart_button" type="submit" value="Pridėti į krepšelį">
                          </div>
                        </div>
                    </form>
                </div>

                <div class="mt-2 mb-2 d-flex flex-column flex-sm-row align-items-sm-center">
                    @role('Administratorius')
                      <div class="red_button add_to_cart_button">
                        <button class="red_button add_to_cart_button"><a href="{{ url('/prekes/'.$item->id.'/edit')}}">Redaguoti</a></button>
                      </div>
                    @endrole

                    @role('Administratorius')
                      <form action="{{ url('/prekes/'.$item->id)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <div class="ml-3 red_button add_to_cart_button">
                            <button type="submit" class="red_button add_to_cart_button"><a style="color: #FFFFFF;">Ištrinti prekę</a></button>
                        </div>
                      </form>
                    @endrole
                </div>

            </div>
        </div>
    </div>
</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
<script src="js/single_custom.js"></script>
@endsection
