@extends('layouts.admin')

@section('content')


<h1 class="text-center my-5 fw-bold">{{$house[0]->title}}</h1>

<div class="row row-cols-xl-2 p-5 pt-2 ">

    <div class="col-12 col-xl-6 mb-5 mb-xl-0 ">
        <h3 class="text-center mb-4">Messaggi ricevuti mensilmente</h3>
        <canvas id="dataMes"></canvas>

    </div>


    <div class="col-12 col-xl-6 mb-5 mb-xl-0">
        <h3 class="text-center mb-4">Visualizzazioni mensili</h3>
        <canvas id="dataVis"></canvas>
    </div>


    <div class="col-12 mt-xl-5 col-xl-6 ">
        <h3 class="text-center mb-4">Sponsorizzazioni mensili</h3>
        <canvas id="dataSpo"></canvas>
    </div>

</div>



@vite('resources/js/app.js')
@endsection
