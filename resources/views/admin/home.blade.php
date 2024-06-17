@php
use App\Functions\Helper as Helper;
@endphp

@extends('layouts.admin')

@section('content')

<div class=" overflow-y-scroll  p-5 text-center">

    <h1 class="mb-4">Home della dashboard di {{Auth::user()->name}}</h1>

    <h2 class="mb-5">Sono presenti {{$house_number}} castelli!</h2>



    <div>

        <h2 class="mb-4">Ultimo Castello aggiunto: {{Helper::formatDate($last_house?->updated_at)}}</h2>

        <h3 class="mb-3">{{$last_house?->title}}</h3>
        <h3>{{$last_house?->description}}</h3>


    </div>


</div>





@endsection
