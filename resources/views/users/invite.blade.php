@extends('layout')

@section('title')
Pakvietimai
@endsection

@section('content')
<div class="container content">
  <div class="row">
    <div id="page" class="col-sm-12 text-center">
      <h2>Pakvieskite savo draugus!</h2>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <label for="invite-link" class="col-form-label">Jūsų individuali pakvietimo nuoroda</label>
      <div class="input-group">
        <input
          id="invite-link"
          class="form-control"
          value="{{ route('home', ['ref' => $inv->nuoroda]) }}"
          readonly
          aria-describedby="copy-link">
        <button
          type="button"
          class="btn btn-danger"
          data-toggle="tooltip"
          data-placement="top"
          title="Kopijuoti nuorodą"
          onclick="copyToClipboard()">
          <i class="fa fa-copy"></i>
        </button>
      </div>

      <h4 class="mt-4">
        @if($inv->pakviesta_zmoniu == 0)
        Jūs
        <span class="text-danger">nieko</span>
        nesate pakvietę
        <i class="fas fa-heart-broken"></i>
        @else
        Jūs esate pakvietę <span class="text-danger">{{ $inv->pakviesta_zmoniu }}
          @if(($inv->pakviesta_zmoniu >= 11 && $inv->pakviesta_zmoniu <= 19) || $inv->pakviesta_zmoniu % 10 == 0)
          draugų!
          @else
            @if($inv->pakviesta_zmoniu % 10 == 1)
            draugą!
            @else
            draugus!
            @endif
          @endif
        </span>
        @endif
      </h4>

      @if($inv->nuolaida > 0)
      <h5>
        Jums yra taikoma
        <span class="text-danger">{{ $inv->nuolaida*100 }}%</span>
        nuolaida!
      </h5>
      @endif
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  function copyToClipboard() {
    var link = document.getElementById("invite-link");
    link.select();
    link.setSelectionRange(0, 420);  // For mobile devices
    document.execCommand("copy");
  }
</script>
@endsection
