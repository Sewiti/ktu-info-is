@extends('layout')

@section('title')
  Apmokėjimas
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
    <div class="row pb-4">
      <div class="col">
        @if(\Illuminate\Support\Facades\Auth::user())
          @if(session('success'))
            <div class="row">
              <div class="col-lg-12">
                <div class="alert alert-success"> {{ session('success') }}</div>
              </div>
            </div>
          @endif
          @if(session('error'))
            <div class="row">
              <div class="col-lg-12">
                <div class="alert alert-danger"> {{ session('error') }}</div>
              </div>
            </div>
          @endif
          @if($errors->any())
            <div class="row">
              <div class="col-lg-12">
                <div class="alert alert-danger">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }} </li>
                  @endforeach
                </div>
              </div>
            </div>
          @endif
          <div class="accordion accordion-modern" id="accordion">
            <div class="card card-default">
              <div class="card-header">
                <h4 class="m-0 text-uppercase">
                  Užsakymo duomenys
                </h4>
              </div>
              <div id="collapseOne" class="collapse show">
                <div class="card-body">
                  <form action="{{ action('PaymentController@store') }}" id="form" method="post">
                    @csrf
                    <div class="form-row">
                      <div class="form-group col-lg-6">
                        <label class="font-weight-bold text-dark text-2">Vardas</label>
                        <input type="text" value="{{ \Illuminate\Support\Facades\Auth::user()->vardas }}" class="form-control" disabled>
                      </div>
                      <div class="form-group col-lg-6">
                        <label class="font-weight-bold text-dark text-2">Pavardė</label>
                        <input type="text" value="{{ \Illuminate\Support\Facades\Auth::user()->pavarde }}" class="form-control" disabled>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col">
                        <label class="font-weight-bold text-dark text-2">El. Pašto adresas</label>
                        <input type="text" name="phone" value="{{ \Illuminate\Support\Facades\Auth::user()->email }}" class="form-control" disabled>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col">
                        <label class="font-weight-bold text-dark text-2">Adresas</label>
                        <input type="text" name="adresas" value="{{ \Illuminate\Support\Facades\Auth::user()->adresas }}" class="form-control">
                      </div>
                      <div class="form-group col">
                        <label class="font-weight-bold text-dark text-2">Pašto kodas</label>
                        <input type="text" name="pasto_kodas" value="{{ \Illuminate\Support\Facades\Auth::user()->pasto_kodas }}" class="form-control">
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col">
                        <label class="font-weight-bold text-dark text-2">Miestas</label>
                        <input type="text" name="miestas" value="{{ \Illuminate\Support\Facades\Auth::user()->miestas }}" class="form-control">
                      </div>
                      <div class="form-group col">
                        <label class="font-weight-bold text-dark text-2">Šalis</label>
                        <input type="text" name="salis" value="{{ \Illuminate\Support\Facades\Auth::user()->salis }}" class="form-control">
                      </div>
                    </div>
                    <p style="color: red">Visi laukeliai privalomi!</p>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="actions-continue">
            <input form="form" type="submit" value="Užsakyti" class="btn btn-rounded btn-danger btn-modern font-weight-bold text-uppercase mt-5 mb-5 px-5 text-3 mb-lg-2">
          </div>
        @else
          <section class="mt-4 call-to-action with-borders mb-5 appear-animation animated fadeIn appear-animation-visible" data-appear-animation="fadeIn" style="animation-delay: 100ms; background-color: white">
            <div class="col-sm-12 col-lg-12">
              <div class="call-to-action-content">
                <h3>Reikalingas prisijungimas</h3>
                <p class="mb-0">Norėdami apmokėti užsakymą, jūs privalote prisijungti arba užsiregistruoti.</p>
              </div>
            </div>
            <div class="col-sm-12 col-lg-12">
              <div class="call-to-action-btn">
                <a href="{{ url('/prisijungimas') }}" class="btn btn-modern text-2 btn-danger mt-3">Prisijungti</a>
              </div>
            </div>
          </section>
        @endif
      </div>
    </div>
  </div>
@endsection
