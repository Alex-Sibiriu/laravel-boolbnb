@extends('layouts.admin')

@section('content')



    <div class="container show">
      <h1 class="text-center">{{$house->title}}</h1>

      <div class="text-center">

          <img src="https://ih1.redbubble.net/image.4905811447.8675/flat,750x,075,f-pad,750x1000,f8f8f8.jpg" alt="" width="100">
      </div>

      <div>
          @if ($house->is_visible === 1)
              <i class="fa-solid fa-circle text-success"></i>
          @else
              <i class="fa-solid fa-circle text-danger"></i>
          @endif
      </div>

      <p>{{$house->description}}</p>
      <p>
          address
      </p>
      <p>{{$house->square_meters}} mq</p>
      <p>Numero stanze: {{$house->rooms}}</p>
      <p>Bagni: {{$house->bathrooms}}</p>
      <p>Posti letto: {{$house->bed}}</p>
    </div>


@endsection
