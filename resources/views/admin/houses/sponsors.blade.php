@extends('layouts.admin')

@section('content')
<div class="row row-sponsor py-4">
    @foreach ($sponsors as $sponsor )

    <div class="col col-sponsor">

        <div class="card-sponsor">
            <div class="title text-uppercase d-flex justify-content-center align-items-center">
                {{$sponsor->name}}
            </div>
            <div class="content">
              <h3><strong class="me-2">Price:</strong>{{$sponsor->price}} &euro;</h3>
              <p><strong class="me-2">Durata:</strong>{{$sponsor->duration}}H</p>
              <a href="{{route('admin.payment.index', ['sponsor' => $sponsor , 'house' => $house])}}" class="btn btn-info">Compra</a>
            </div>

          </div>
    </div>

    @endforeach
</div>
@endsection
