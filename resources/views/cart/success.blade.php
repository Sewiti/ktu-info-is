@extends('layout')

@section('title')
  Patvirtinta
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
    <section class="section custom-section-full-width bg-color-transparent border-0 mt-1 mb-1" style="background-image: url({{ url('img/demos/it-services/backgrounds/dots-background-4.png') }}); background-position: top right;">
      <div class="container">
        <section class="call-to-action with-borders mb-5 appear-animation animated fadeIn appear-animation-visible" data-appear-animation="fadeIn" style="animation-delay: 100ms; background-color: white">
          <div class="col-sm-9 col-lg-9">
            <div class="call-to-action-content">
              <h3>Užsakymas apmokėtas</h3>
              <p class="mb-0">Užsakymas sėkmingai apmokėtas ir patvirtintas</p>
            </div>
          </div>
        </section>
      </div>
    </section>
  </div>
@endsection
