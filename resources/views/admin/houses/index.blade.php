@extends('layouts.admin')

@section('content')
  <div class="row py-2 px-5 justify-content-between">
    <div class="col-12">
        {{-- alert di avvenuta cancellazione  --}}
        @if(session('deleted'))
        <div class="alert alert-success" role="alert">
        {{ session('deleted')}}
        </div>
        @endif
    </div>

    <div class="col-4 my-3">
        <form action="{{route('admin.houses.index')}}" method="GET" class="d-flex" role="search">
            <input name="toSearch" class=" toSearch form-control me-2" type="search" placeholder="Cerca" aria-label="Search">

            <button class="btn btn-outline-success" type="submit"><i class="fa-solid fa-circle-chevron-right"></i></button>
          </form>
    </div>
    <div class="col-4 my-3 text-end">
        <a href="{{route('admin.houses.create')}}" class="btn btn-primary"><i class="fa-solid fa-plus"></i></a>
    </div>
  </div>

  <div class="row pt-2 pb-5 px-5">
    <div class="col-12">
      <div class="px-2 bg-dark rounded-3 pb-1">
        <h2 class="py-3 text-white rounded-3 fw-bold fs-2 p-3 mt-3">I tuoi Castelli</h2>

        <table class="table table-dark table-striped">
          @if (count($houses) > 0)
            <thead>
              <tr>
                <th class="ps-3 id-column" scope="col"><a href="{{route('admin.orderby', ['direction' => $direction , 'column'=> 'id'])}}">ID</a></th>
                <th scope="col">Immagine</th>
                <th scope="col"><a href="{{route('admin.orderby', ['direction' => $direction , 'column' => 'title'])}}">Nome</a></th>
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

                  @include('admin.partials.formdelete', [
                    'route' => route('admin.houses.destroy', $house),
                    'message' => "Sei sicuro di voler eliminare  $house->title ?"
                  ])
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
