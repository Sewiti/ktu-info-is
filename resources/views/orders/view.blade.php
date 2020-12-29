@extends('layout')

@section('title')
  Užsakymas #{{ $order->id }}
@endsection

@section('content')
  <div class="container single_product_container">
    <div class="row">
      <div class="col-sm-12 table table-responsive mt-5">
        <table class="table">
          <thead>
            <tr>
              {{-- <th>#ID</th> --}}
              <th>Prekė</th>
              <th>Kiekis</th>
              <th>Kaina</th>
            </tr>
          </thead>
          <tbody>
            @foreach($items as $item)
              <tr>
                {{-- <td>{{ $item->id }}</td> --}}
                <td><a href="{{ route('prekes.show', ['item'=>$item->id]) }}">{{ $item->pavadinimas }}</a></td>
                <td>{{ $item->kiekis }} vnt.</td>
                <td>{{ number_format($item->kaina * $item->kiekis, 2, '.', '') }} €</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
