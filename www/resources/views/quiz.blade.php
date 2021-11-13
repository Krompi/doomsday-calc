@extends('layouts.app')

@section('heading')
    Start
@endsection

@section('content')
<!-- component -->
<div class="container">
    <div class="flex flex-col md:grid grid-cols-11 text-gray-800">

        <div class="flex md:contents">
            <div class="col-start-1 col-end-2 mr-10 md:mx-auto relative">
                <div class="h-full w-6 flex items-center justify-center">
                    <div class="h-full w-1 bg-blue-500 pointer-events-none"></div>
                </div>
                <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-blue-500 shadow text-center">
                    <i class="fas fa-check-circle text-white"></i>
                </div>
            </div>
            <div class="bg-blue-500 col-start-2 col-end-12 p-4 rounded-xl my-4 mr-auto shadow-md w-full">
                <h3 class="font-semibold text-lg mb-1">gesuchtes Datum</h3>
                <p class="leading-tight text-justify w-full text-5xl">
                    {{ date('d.m.Y', strtotime($date)) }}
                </p>
            </div>
        </div>

        <div class="flex md:contents">
            <div class="col-start-1 col-end-2 mr-10 md:mx-auto relative">
                <div class="h-full w-6 flex items-center justify-center">
                    <div class="h-full w-1 bg-blue-500 pointer-events-none"></div>
                </div>
                <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-blue-500 shadow text-center">
                    <i class="fas fa-check-circle text-white"></i>
                </div>
            </div>
            <div class="bg-blue-100 col-start-2 col-end-12 p-4 rounded-xl my-4 mr-auto shadow-md w-full">
                <h3 class="font-semibold text-lg mb-1">Jahrhundert-Anker-Datum</h3>
                <p class="leading-tight text-justify w-full">

                    @foreach ($weekdays as $weekday)
                        <button
                            @if ( $weekday == $output["century_doomsday_text"] )
                                data-value="true"
                            @else 
                                data-value="false"
                            @endif
                            class="font-bold py-2 px-4 bg-blue-500 hover:bg-blue-700 text-white rounded centuryWeekday">
                            {{ $weekday }}
                        </button>
                    @endforeach

                </p>
            </div>
        </div>

<div class="flex md:contents">
    <div class="col-start-1 col-end-2 mr-10 md:mx-auto relative">
        <div class="h-full w-6 flex items-center justify-center">
            <div class="h-full w-1 bg-blue-500 pointer-events-none"></div>
        </div>
        <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-blue-500 shadow text-center">
            <i class="fas fa-check-circle text-white"></i>
        </div>
    </div>
    <div class="bg-blue-200 col-start-2 col-end-12 p-4 rounded-xl my-4 mr-auto shadow-md w-full">
        <h3 class="font-semibold text-lg mb-1">Jahres-Anker-Datum</h3>
        <p class="leading-tight text-justify w-full">
            {{ $output["year_doomsday_text"] }}
        </p>
    </div>
</div>

<div class="flex md:contents">
    <div class="col-start-1 col-end-2 mr-10 md:mx-auto relative">
        <div class="h-full w-6 flex items-center justify-center">
            <div class="h-full w-1 bg-blue-500 pointer-events-none"></div>
        </div>
        <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-blue-500 shadow text-center">
            <i class="fas fa-check-circle text-white"></i>
        </div>
    </div>
    <div class="bg-blue-500 col-start-2 col-end-12 p-4 rounded-xl my-4 mr-auto shadow-md w-full">
        <h3 class="font-semibold text-lg mb-1">gesuchter Wochentag</h3>
        <p class="leading-tight text-justify w-full">
            {{ $output["result_day_text"] }}
        </p>
    </div>
</div>

        <div class="flex md:contents">
          <div class="col-start-2 col-end-4 mr-10 md:mx-auto relative">
            <div class="h-full w-6 flex items-center justify-center">
              <div class="h-full w-1 bg-green-500 pointer-events-none"></div>
            </div>
            <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-green-500 shadow text-center">
              <i class="fas fa-check-circle text-white"></i>
            </div>
          </div>
          <div class="bg-green-500 col-start-4 col-end-12 p-4 rounded-xl my-4 mr-auto shadow-md w-full">
            <h3 class="font-semibold text-lg mb-1">Out for Delivery</h3>
            <p class="leading-tight text-justify">
              22 July 2021, 01:00 PM
            </p>
          </div>
        </div>

        <div class="flex md:contents">
          <div class="col-start-2 col-end-4 mr-10 md:mx-auto relative">
            <div class="h-full w-6 flex items-center justify-center">
              <div class="h-full w-1 bg-red-500 pointer-events-none"></div>
            </div>
            <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-red-500 shadow text-center">
              <i class="fas fa-times-circle text-white"></i>
            </div>
          </div>
          <div class="bg-red-500 col-start-4 col-end-12 p-4 rounded-xl my-4 mr-auto shadow-md w-full">
            <h3 class="font-semibold text-lg mb-1 text-gray-50">Cancelled</h3>
            <p class="leading-tight text-justify">
              Customer cancelled the order
            </p>
          </div>
        </div>

        <div class="flex md:contents">
          <div class="col-start-2 col-end-4 mr-10 md:mx-auto relative">
            <div class="h-full w-6 flex items-center justify-center">
              <div class="h-full w-1 bg-gray-300 pointer-events-none"></div>
            </div>
            <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-gray-300 shadow text-center">
              <i class="fas fa-exclamation-circle text-gray-400"></i>
            </div>
          </div>
          <div class="bg-gray-300 col-start-4 col-end-12 p-4 rounded-xl my-4 mr-auto shadow-md w-full">
            <h3 class="font-semibold text-lg mb-1 text-gray-400">Delivered</h3>
            <p class="leading-tight text-justify">

            </p>
          </div>
        </div>

      </div>
    </div>

    <script>
        var classname = document.getElementsByClassName("centuryWeekday");

        var myFunction = function() {
            var attribute = this.getAttribute("data-value");
            alert(attribute);
        };

        for (var i = 0; i < classname.length; i++) {
            classname[i].addEventListener('click', myFunction, false);
        }
    </script>
     
@endsection