@php
use App\Functions\Helper as Helper;
@endphp

@extends('layouts.admin')

@section('content')

<div class="  p-5 ">

    <h1 class="mb-2">Ciao {{Auth::user()->name}}</h1>

    <h2 class="mb-5">Sono presenti {{$house_number}} castelli</h2>



    <div>
        @if ($last_house)
        <h3 class="mb-2">Ultimo Castello aggiunto: {{Helper::formatDate($last_house?->updated_at)}}</h3>

        <h3 class="mb-2">{{$last_house?->title}}</h3>
        <h3>{{$last_house?->description}}</h3>
        @endif


    </div>


</div>





@endsection
