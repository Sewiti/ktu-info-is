<!DOCTYPE html>
<html lang="lt">

<head>
  <title>Elektronikos taisykla | @yield('title')</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Elektronikos taisykla">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.rawgit.com/nizarmah/calendar-javascript-lib/master/calendarorganizer.min.css"
    rel="stylesheet" />

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
    integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
    crossorigin="anonymous" />

  <link rel="stylesheet" type="text/css" href="{{ url('/styles/bootstrap4/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('/styles/main_styles.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('/styles/responsive.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('/styles/single_styles.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('/styles/single_responsive.css') }}">
  @yield('style')
  <style>
    .btn:hover {
      cursor: pointer;
    }
  </style>
  <base href="https://minde.medialive.lt/info/" />
  <meta name="verify-paysera" content="dfe3fa71824849e8e48df01e7f6093cf">
</head>

<body>
  <div class="super_container">

    @include('blocks.header')

    @yield('content')

    @include('blocks.footer')

  </div>

{{--  <script src="/info/js/jquery-3.2.1.min.js"></script>--}}
  <script src="/info/styles/bootstrap4/popper.js"></script>
  <script src="/info/styles/bootstrap4/bootstrap.min.js"></script>
  <script src="/info/plugins/Isotope/isotope.pkgd.min.js"></script>
  <script src="/info/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
  <script src="/info/plugins/easing/easing.js"></script>
  <script src="/info/js/custom.js"></script>
  @yield('script')
</body>

</html>
