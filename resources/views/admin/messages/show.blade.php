@extends('layouts.admin')

@section('content')
  <div class="py-3 show">
    <h1 class="text-center fw-bold my-3">{{ $message->title }}</h1>

    <div class="container d-flex justify-content-center">
      <div class="bg-dark w-100 text-white p-3 rounded-3 mb-3">
        <p><strong>Riferito al Castello: </strong>{{ $message->house->title }}</p>
        <p><strong>Inviato da:</strong> {{ $message->email }}</p>
        <p class="bg-secondary m-0 p-2 rounded-2">{{ $message->message }}</p>
      </div>
    </div>

    <div class="container text-center">
      @include('admin.partials.formdelete', [
          'route' => route('admin.messages.destroy', $message),
          'message' => 'Sei sicuro di voler eliminare il messaggio?',
      ])
      <a href="{{ route('admin.messages.index') }}" class="btn btn-success">Torna ai Messaggi</a>
    </div>
  </div>
@endsection
