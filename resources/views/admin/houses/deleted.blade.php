@extends('layouts.admin')

@section('content')
  <div class="row pt-2 pb-5 px-5">

    <div class="col-12">
      <div class="px-2 pb-1">
        <h2 class="py-3 text-dark rounded-3 fw-bold fs-2 p-3 mt-3">Castelli cancellati</h2>


        <table class="table table-light table-striped">
          @if (count($houses) > 0)
            <thead>
              <tr>

                <th scope="col">Immagine</th>
                <th scope="col">
                  Nome
                </th>

                <th class="text-center" scope="col">Azioni</th>
              </tr>
            </thead>
          @endif
          <tbody class="table-group-divider">

            @forelse ($houses as $house)
              <tr>

                <td class="align-content-center">

                  <img src="{{ asset('storage/' . $house?->images->first()?->image_path) }}" alt="{{ $house?->title }}"
                    width="100" onerror="this.src='/img/not-found.jpg'">

                </td>

                <td class="align-content-center">
                  {{ $house->title }}
                </td>

                <td class="align-content-center text-center">

                  <form action="{{ route('admin.retrieve', $house->id) }}" method="POST" class="d-inline-block">
                    @method('PUT')
                    @csrf
                    <button type="submit" class="btn btn-success">
                      <i class="fa-solid fa-recycle"></i>
                    </button>
                  </form>

                </td>

              </tr>
            @empty
              <h3 class="text-dark ms-3">Nessun Castello Cancellato</h3>
            @endforelse

          </tbody>
        </table>

      </div>
    </div>
  </div>
@endsection
