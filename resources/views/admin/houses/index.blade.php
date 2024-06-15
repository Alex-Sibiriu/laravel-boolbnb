@extends('layouts.admin')

@section('content')
  <div class="row pt-2 pb-5 px-5">

    <div class="col-12">
      @if (session('success'))
        <div class="alert alert-success" role="alert">
          <p class="m-0">{{ session('success') }}</p>
        </div>
      @endif
    </div>

    <div class="col-12">
      <div class="px-2 bg-dark rounded-3 pb-1">
        <h2 class="py-3 text-white rounded-3 fw-bold fs-2 p-3 mt-3">I tuoi Castelli</h2>

        <table class="table table-dark table-striped">
          @if (count($houses) > 0)
            <thead>
              <tr>
                <th class="ps-3 id-column" scope="col">ID</th>
                <th scope="col">>Immagine</th>
                <th scope="col">Nome</th>
                <th scope="col">Sponsor</th>
                <th scope="col">Pubblica</th>
                <th class="text-center" scope="col">Azioni</th>
              </tr>
            </thead>
          @endif
          <tbody>

            @forelse ($houses as $house)
              <tr>
                <td class="ps-3">{{ $house->id }}</td>

                <td class="align-content-center">
                  IMMAGINE
                </td>

                <td class="align-content-center">
                  {{ $house->title }}
                </td>

                <td class="align-content-center">
                  @if ($house->sponsors()->exists())
                    Si
                  @else
                    No
                  @endif
                </td>

                <td class="align-content-center text-center">
                  @if ($house->is_visible === 1)
                    <i class="fa-solid fa-circle text-success"></i>
                  @else
                    <i class="fa-solid fa-circle text-danger"></i>
                  @endif
                </td>

                <td class="text-center">
                  <a href="{{ route('admin.houses.show', $house) }}" class="btn btn-info me-2">
                    <i class="fa-solid fa-eye"></i>
                  </a>

                  <a href="{{ route('admin.houses.edit', $house) }}" class="btn btn-warning me-2">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </a>

                  <form action="{{ route('admin.houses.destroy', $house) }}" method="POST"
                    onsubmit="return confirm('Sei sicuro di voler eliminare {{ $house->title }}?')"
                    class="d-inline-block">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                  </form>
                </td>

              </tr>
            @empty
              <h2 class="text-white">Nessun Castello Trovato</h2>
            @endforelse

          </tbody>
        </table>
        {{ $houses->links() }}
      </div>
    </div>
  </div>
@endsection
