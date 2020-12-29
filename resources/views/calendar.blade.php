@extends('layout')

@section('title')
Kalendoriaus langas
@endsection

@section('content')
<div class="container content text-center">
  {{-- <div class="row">
        <div id="page" class="col-sm-12">
            <h2>Kalendoriaus langas</h2>
        </div>
    </div> --}}
  <div class="row">
    <div class="col-sm-12">
      <div id="calendarContainer" class="d-flex justify-content-center"></div>

      {{-- <a class="btn btn-warning" style="margin: 5px;" href="{{ url('/') }}">Pagrindinis</a>
      <a class="btn btn-danger" style="margin: 5px;" href="{{ url('/paslaugos/sukurti') }}">Paslaugos kūrimo
        langas</a> --}}
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="https://cdn.rawgit.com/nizarmah/calendar-javascript-lib/master/calendarorganizer.min.js"></script>
<script>
  var calendar = new Calendar(
    "calendarContainer", // HTML container ID
    "large", // Size: (small, medium, large)
    ["Sekmadienis",
      3
    ], // [ Starting day, day abbreviation length ] Required
    ["#800E13", // Primary Color Required
      "#640D14", // Primary Dark Color Required
      "#E8E9F3", // Text Color Required
      "#E8E9F3"
    ],
    {
      days: ["Sekmadienis", "Pirmadienis", "Antradienis", "Trečiadienis", "Ketvirtadienis", "Penktadienis", "Šeštadienis"
      ],
      months: ["Sausis", "Vasaris", "Kovas", "Balandis", "Gegužė", "Birželis", "Liepa", "Rugpjūtis",
        "Rugsėjis",
        "Spalis", "Lapkritis", "Gruodis"
      ],
      indicator: true, // Day Event Indicator                                                                    Optional
      indicator_type: 1, // Day Event Indicator Type (0 not to display num of events, 1 to display num of events)  Optional
      indicator_pos: "bottom", // Day Event Indicator Position (top, bottom)                                             Optional
      placeholder: "<span>Custom Placeholder</span>"
    });


    

    var dates = {!! json_encode($rezervacijos->toArray()) !!};

    var dateNow = new Date();
    var yearNow = Number(dateNow.getFullYear());
    var monthNow = Number(dateNow.getMonth());

    var firstDayOfMonth = new Date(yearNow, monthNow, 1).toDateString().slice(0, 3);
    var firstDayOfMonthIndex = getDayIndex();

    dates.forEach(item => {
      var year = Number(item.pradzios_laikas.slice(0, 4));
      var month = Number(item.pradzios_laikas.slice(5, 7));
      var day = Number(item.pradzios_laikas.slice(8, 10)) + firstDayOfMonthIndex;

      if (year == yearNow && month == monthNow + 1) {
        $(document).ready(function() {
          $('#calendarContainer-day-' + day).css('background-color', '#800E13');
          $('#calendarContainer-day-num-' + day).css('color', '#E8E9F3');
          $('#calendarContainer-day-' + day).prop('disabled', false);
        });
      }
    });


  calendar.setOnClickListener('days-blocks',
    function () {
      var year = document.getElementById('calendarContainer-year').textContent;
      var monthName = document.getElementById('calendarContainer-month').textContent;
      var month = ("00" + (calendar.months.findIndex(item => item == monthName) + 1)).slice(-2);
      var day = ("00" + event.srcElement.textContent).slice(-2);
      var date = `${year}-${month}-${day}`;

      location.href = '{{ url('/uzduotys/sukurti') }}' + '/' + date;
    }
  ); 

  function getDayIndex() {
    firstDayOfMonthIndex = -1;

    switch (firstDayOfMonth) {
      case "Mon":
        firstDayOfMonthIndex = 1;
        break;
      case "Tue":
        firstDayOfMonthIndex = 2;
        break;
      case "Thu":
        firstDayOfMonthIndex = 3;
        break;
      case "Wed":
        firstDayOfMonthIndex = 4;
        break;
      case "Fri":
        firstDayOfMonthIndex = 5;
        break;
      case "Sat":
        firstDayOfMonthIndex = 6;
        break;
        firstDayOfMonthIndex = 7;
      case "Sun":
        break;
    }

    return firstDayOfMonthIndex;
  }

</script>
@endsection
