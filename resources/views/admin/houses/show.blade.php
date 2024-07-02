@php
      use App\Functions\Helper;
@endphp
@extends('layouts.admin')

@section('content')
  <div class="py-3 px-5 show">

    <div class="col-12 px-3">
      @if (session('success'))
        <div class="alert alert-success container" role="alert">
          {{ session('success') }}
        </div>
      @endif

      @if (session('update'))
        <div class="alert alert-success container" role="alert">
          {{ session('update') }}
        </div>
      @endif
    </div>

    <h1 class="text-center fw-bold my-3">{{ $house->title }}</h1>

    <h2 class="text-center my-5">Immagine di copertina</h2>

    <div class="text-center mb-5 ">
      @if ($house->images->count() > 0)
        <img src="{{ asset('storage/' . $house->images->first()->image_path) }}" alt="{{ $house->title }}"
          class="house-image">
      @else
        <img src="https://ih1.redbubble.net/image.4905811447.8675/flat,750x,075,f-pad,750x1000,f8f8f8.jpg" alt=""
          class="house-image">
      @endif
    </div>

    <div class="container d-flex flex-column justify-content-between flex-lg-row ">
      <div class="container-show">
        <p><strong>Annuncio visibile:</strong>
          @if ($house->is_visible == 1)
            <i class="fa-solid fa-circle text-success"></i>
          @else
            <i class="fa-solid fa-circle text-danger"></i>
          @endif
        </p>

        <p class="pe-3"><strong>Descrizione: </strong>{{ $house->description }}</p>
        <p><strong>Indirizzo:</strong> {{ $house->address }}</p>
        <p><strong>Metri quadri:</strong> {{ $house->square_meters }} mq</p>
        <p><strong>Numero stanze:</strong> {{ $house->rooms }}</p>
        <p><strong>Bagni:</strong> {{ $house->bathrooms }}</p>
        <p><strong>Posti letto:</strong> {{ $house->bed }}</p>
      </div>

      <div>

        @if ($house->services->count() > 0)

        <p><strong>Servizi:</strong></p>
        <ul class=" list-unstyled">
            @forelse ($house->services as $service)
            <li class="me-2"> <span class="icone"><i class="{{ $service->icon }}"></i></span> {{ $service->name }} </li>
            @empty
            @endforelse
        </ul>
        @endif

        @if ($house->sponsors->count() > 0)
        <p><strong>Sponsor attivi:</strong></p>
            <ul>
                @foreach ($house->sponsors as $sponsor)
                @php


                    $start  = Helper::formatDateandTime($sponsor->pivot->start_date );
                    $expire = Helper::formatDateandTime($sponsor->pivot->expiration_date );
                @endphp
                <li class="text-capitalize">
                    {{ $sponsor->name }}:  {{ $start}} - {{ $expire }}
                </li>
            @endforeach
            </ul>
        @endif
      </div>
    </div>

    @if ($house->images->count() > 1)
      <h2 class="text-center my-5">Altre immagini</h2>
      <div class="row mx-5 d-flex justify-content-center">
        @foreach ($house->images->skip(1) as $image)
          <div class="col-md-4 mb-3">
            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Image" class="img-fluid">
          </div>
        @endforeach
      </div>
    @endif


    <div class="tools text-center">
        <a href="{{ route('admin.houses.edit', $house) }}" > <i
            class="fa-solid fa-pen-to-square m-2"></i></a>

        <a href="{{ route('admin.sponsors', $house) }}"><i class="fa-solid fa-rocket m-2"></i></a>

        <a href="{{ route('admin.stats', $house) }}"><i class="fa-solid fa-chart-simple m-2"></i></a>

        @include('admin.partials.formdelete', [
            'route' => route('admin.houses.destroy', $house),
            'message' => "Sei sicuro di voler eliminare  $house->title ?",
        ])

        <a href="{{ route('admin.home') }}"><i class="fa-solid fa-arrow-right-from-bracket m-2"></i></a>
    </div>
</div>
@endsection
