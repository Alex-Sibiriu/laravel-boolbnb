@extends('layouts.admin')

@section('content')
    <div class="py-3 show">
        <h1 class="text-center my-3">{{ $house->title }}</h1>

        <div class="text-center">
            @if ($house->images->count() > 0)
                <img src="{{ asset('storage/'. $house->images->first()->image_path) }}" alt="{{ $house->title }}" class="house-image">
            @else
                <img src="https://ih1.redbubble.net/image.4905811447.8675/flat,750x,075,f-pad,750x1000,f8f8f8.jpg"
                    alt="" class="house-image">
            @endif
        </div>

        <div>
            @if ($house->is_visible == 1)
                <i class="fa-solid fa-circle text-success"></i>
            @else
                <i class="fa-solid fa-circle text-danger"></i>
            @endif
        </div>

        <p>{{ $house->description }}</p>
        <p>{{ $house->address }}</p>
        <p>{{ $house->square_meters }} mq</p>
        <p>Numero stanze: {{ $house->rooms }}</p>
        <p>Bagni: {{ $house->bathrooms }}</p>
        <p>Posti letto: {{ $house->bed }}</p>

        @if ($house->images->count() > 1)
            <h2>Altre immagini</h2>
            <div class="row">
                @foreach ($house->images->skip(1) as $image)
                    <div class="col-md-4 mb-3">
                        <img src="{{ asset('storage/'. $image->image_path) }}" alt="Image" class="img-fluid">
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
