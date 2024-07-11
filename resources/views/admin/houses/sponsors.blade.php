@extends('layouts.admin')

@section('content')
  <div class="row row-sponsor py-4">
    @foreach ($sponsors as $sponsor)
      <div class="col col-sponsor">

        <div class="card-sponsor">
          <div
            class="title text-uppercase d-flex justify-content-center align-items-center @if ($sponsor->name === 'silver') silver

            @elseif ($sponsor->name === 'gold') gold
            @else
                platinum @endif">
            {{ $sponsor->name }}
          </div>
          <div class="content">
            <h3><strong class="me-2">Prezzo:</strong>{{ $sponsor->price }} &euro;</h3>
            <p><strong class="me-2">Durata:</strong>{{ $sponsor->duration }}H</p>
            <a href="{{ route('admin.payment.index', ['sponsor' => $sponsor, 'house' => $house]) }}"
              class="btn btn-sponsor">Compra</a>
          </div>

        </div>
      </div>
    @endforeach
  </div>
@endsection
