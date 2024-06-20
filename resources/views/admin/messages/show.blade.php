@extends('layouts.admin')

@section('content')
  <div class="py-3 m-3 show">

    <div class="container d-flex justify-content-center">
      <div class="w-100 text-dark p-3 mb-3">
        <p><strong>Riferito al Castello: </strong>{{ $message->house->title }}</p>
        <p><strong>Inviato da:</strong> {{ $message->email }}</p>
        <p class="m-0 p-2 rounded-2 bg-body-secondary">{{ $message->message }}</p>
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
