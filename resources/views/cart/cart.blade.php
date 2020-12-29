@extends('layout')

@section('title')
  Krepšelis
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
      <div class="col">
        @if(Session::has('cart'))
          <div class="featured-box featured-box-primary text-left mt-2">
            <div class="box-content">
              <table class="table shop_table cart table-responsive-sm">
                <thead>
                <tr>
                  <th class="product-remove">&nbsp;</th>
                  <th>Pavadinimas</th>
                  <th>Kiekis</th>
                  <th>Pradinė kaina</th>
                  <th>Nuolaida</th>
                  <th>PVM (21%)</th>
                  <th>Galutinė kaina</th>
                </tr>
                </thead>
                <tbody>
                @php
                  $cartCount = 0;
                  $totalCart = 0;
                @endphp
                @foreach($cart as $item)
                  <tr class="cart_table_item mt-4 mb-4">
                    <td class="product-remove">
                      <a class="remove" href="{{ url('/removeFromCart/'.$cartCount) }}">
                        <i class="fas fa-times"></i>
                      </a>
                    </td>
                    <td class="product-name">
                      <a target="_blank" href="{{ url('/prekes/'.$item->id) }}">{{ $item->pavadinimas }}</a>
                    </td>
                    <td class="product-price">
                      <span class="amount">{{ $item->quantity }} vnt.</span>
                    </td>
                    <td class="product-price">
                      <span class="amount">{{ number_format($item->kaina, 2, '.', '') }} €</span>
                    </td>
                    <td class="product-price">
                      @php
                        if(\App\Models\Pakvietimas::find(Auth::user()->pakvietimas)) {
                          $discount = $item->kaina * \App\Models\Pakvietimas::find(Auth::user()->pakvietimas)->nuolaida;
                        } else {
                          $discount = 0;
                        }
                      @endphp
                      <span class="amount">{{ number_format($discount, 2, '.', '') }} €</span>
                    </td>
                    <td class="product-price">
                      <span class="amount">{{ number_format((($item->kaina * $item->quantity) - $discount) * 0.21, 2, '.', '') }} €</span>
                    </td>
                    <td class="product-price">
                      <span class="amount">{{ number_format(($item->kaina * $item->quantity) - $discount, 2, '.', '') }} €</span>
                    </td>
                  </tr>
                  @php
                    $cartCount++;
                    $totalCart += ($item->kaina * $item->quantity) - $discount;
                  @endphp
                @endforeach
                <tr>
                  <td class="actions" colspan="7">
                    <div class="actions-continue mr-sm-4 float-sm-right">
                      <h4>Visa suma : <b>{{ number_format($totalCart, 2, '.', '') }} €</b></h4>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="actions border-top-0" colspan="6">
                    <div class="actions-continue">
                      <a href="{{ url('/apmoketi') }}" class="btn btn-xl btn-light pr-4 pl-4 text-2 font-weight-semibold text-uppercase">Apmokėti</a>
                    </div>
                  </td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
        @else
          <section class="call-to-action with-borders mb-5 appear-animation animated fadeIn appear-animation-visible" data-appear-animation="fadeIn" style="animation-delay: 100ms; background-color: white">
            <div class="col-sm-9 col-lg-9">
              <div class="call-to-action-content">
                <h3>Šiuo metu krepšelyje nieko nėra</h3>
              </div>
            </div>
          </section>
        @endif
      </div>
    </div>
  </div>
@endsection
