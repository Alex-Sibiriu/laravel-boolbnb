@extends('layouts.admin')

@section('content')
  <div class="row py-2 px-5 justify-content-between">
    <div class="col-12">
      {{-- alert di avvenuta cancellazione  --}}
      @if (session('deleted'))
        <div class="alert alert-success" role="alert">
          {{ session('deleted') }}
        </div>
      @endif
    </div>

  </div>

  <div class="row pt-2 pb-5 px-0 px-sm-5 px-md-0 px-lg-5">
    <div class="col-12">
      <div class="px-2  pb-1">
        <h2 class="py-3 text-dark rounded-3 fw-bold fs-2 p-3 mt-3">I tuoi Messaggi</h2>

        <table class="table table-light table-striped table-responsive">
          @if (count($messages) > 0)
            <thead>
              <tr>

                <th scope="col">Relativo a</th>
                <th scope="col" class="d-none d-lg-table-cell">Anteprima</th>
                <th scope="col" class="d-none d-md-table-cell">Data di Ricezione</th>
                <th scope="col">Mittente</th>
                <th class="text-center" scope="col">Azioni</th>
              </tr>
            </thead>
          @endif
          <tbody class="table-group-divider">

            @forelse ($messages as $message)
              <tr>

                <td class="align-content-center">{{ $message->house->title }}</td>

                <td class="align-content-center d-none d-lg-table-cell">
                  <p class="m-0 truncate-text">{{ $message->message }}</p>
                </td>

                <td class="align-content-center d-none d-md-table-cell">
                  {{ \Carbon\Carbon::parse($message->created_at)->format('d/m/y \a\l\l\e H:i') }}</td>

                <td class="align-content-center">{{ $message->email }}</td>

                <td class="align-content-center text-center">

                  <a href="{{ route('admin.messages.show', $message) }}" class="btn btn-info mx-2  mb-2">
                    <i class="fa-solid fa-eye"></i>
                  </a>

                  @include('admin.partials.formdelete', [
                      'route' => route('admin.messages.destroy', $message),
                      'message' => 'Sei sicuro di voler eliminare il messaggio?',
                  ])

                </td>

              </tr>
            @empty
              <h2 class="text-white ms-3">Nessun Messaggio Trovato</h2>
            @endforelse

          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
