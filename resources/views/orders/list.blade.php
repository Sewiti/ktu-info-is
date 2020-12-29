@extends('layout')

@section('title')
  Užsakymai
@endsection

@section('content')
  <div class="container single_product_container">
    <div class="row">
      <div class="col-sm-12 table table-responsive mt-5">
        @if(session('success'))
          <div class="row">
            <div class="col-lg-12">
              <div class="alert alert-success"> {{ session('success') }}</div>
            </div>
          </div>
        @endif
        <table class="table">
          <thead>
            <tr>
              <th>#ID</th>
              <th>Užsakė</th>
              <th>Užsakymo data</th>
              <th>PVM</th>
              <th>Nuolaida</th>
              <th>Visa suma</th>
              <th>Būsena</th>
              <th>Veiksmai</th>
            </tr>
          </thead>
          <tbody>
            @if(count($orders) > 0)
              @foreach($orders as $order)
                <tr>
                  <td>{{ $order->id }}</td>
                  <td>{{ $order->vartotojas->vardas }} {{ $order->vartotojas->pavarde }}</td>
                  <td>{{ $order->data_sukurta }}</td>
                  <td>{{ number_format($order->pvm, 2, '.', '') }} €</td>
                  <td>{{ number_format($order->nuolaida, 2, '.', '') }} €</td>
                  <td>{{ number_format($order->visa_suma, 2, '.', '') }} €</td>
                  <td>@if($order->busena->sortByDesc('atnaujinimo_laikas')->first()->busena == 1) Neapmokėta @else Apmokėta @endif</td>
                  <td>
                    <a href="{{ url('/uzsakymas/'.$order->id) }}" class="btn btn-primary"><i class="fa fa-print"></i></a>
                    @role('Administratorius')
                    <a alt="Pakeisti į neapmokėtą" href="{{ url('/keistiBusena/'.$order->id.'/1') }}" class="btn btn-danger"><i class="fa fa-minus"></i></a>
                    <a alt="Pakeisti į apmokėtą" href="{{ url('/keistiBusena/'.$order->id.'/2') }}" class="btn btn-success"><i class="fa fa-plus"></i></a>
                    @endrole
                  </td>
                </tr>
              @endforeach
            @else
              <tr>
                <td colspan="7">Užsakymų dar nėra</td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
