@extends('layout')

@section('title')
 Būsenos sekimgas #{{ $order->id }}
@endsection

@section('content')
  <div class="container single_product_container">
    <div class="row">
      <div class="col-sm-12 table table-responsive mt-5">
        <table class="table">
          <thead>
            <tr>
              <th>#Užsakymo ID</th>
              <th>Būsena</th>
              <th>Pakeitimo laikas</th>
            </tr>
          </thead>
          <tbody>
            @foreach($status as $stat)
              <tr>
                <td>{{ $order->id }}</td>
                <td>@if($stat->busena == 1) Neapmokėta @else Apmokėta @endif</td>
                <td>{{ $stat->atnaujinimo_laikas }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
