@extends('layouts.admin')

@section('content')
  @php
    $isEdit = isset($house);
  @endphp

  <h1 class="py-5 text-center mt-3 rounded-3 bg-gray">{{ $title }}</h1>

  <h6 class="ps-5">I campi con <strong>(*)</strong> sono obbligatori</h6>

  <form id="houseForm" class="row fw-medium rounded-3 bg-gray p-5" enctype="multipart/form-data" action='{{ $route }}'
    method='POST'>
    @csrf
    @method($method)

    {{-- alert per errori request --}}
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="m-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- titolo --}}
    <div class="col-6 mb-3">
      <label for="title" class="form-label">Titolo (*)</label>
      <input name="title" type="text" placeholder="Inserisci il nome del castello"
        class="form-control @error('title') is-invalid @enderror" id="title"
        value="{{ old('title', $house?->title) }}" required minlength="3" maxlength="100">
      @error('title')
        <small class="text-danger fw-bold">
          {{ $message }}
        </small>
      @enderror
    </div>

    {{-- stanze --}}
    <div class="col-6 mb-3">
      <label for="rooms" class="form-label">Stanze (*)</label>
      <input name="rooms" type="number" placeholder="Inserisci il numero di stanze"
        class="form-control @error('rooms') is-invalid @enderror" id="rooms"
        value="{{ old('rooms', $house?->rooms) }}" required min="1" max="125">
      @error('rooms')
        <small class="text-danger fw-bold">
          {{ $message }}
        </small>
      @enderror
    </div>

    {{-- bagni --}}
    <div class="col-6 mb-3">
      <label for="bathrooms" class="form-label">Bagni (*)</label>
      <input name="bathrooms" type="number" placeholder="Inserisci il numero di bagni"
        class="form-control @error('bathrooms') is-invalid @enderror" id="bathrooms"
        value="{{ old('bathrooms', $house?->bathrooms) }}" required min="1" max="125">
      @error('bathrooms')
        <small class="text-danger fw-bold">
          {{ $message }}
        </small>
      @enderror
    </div>

    {{-- letti --}}
    <div class="col-6 mb-3">
      <label for="bed" class="form-label">Posti Letto (*)</label>
      <input name="bed" type="number" placeholder="Inserisci il numero di posti letto"
        class="form-control @error('bed') is-invalid @enderror" id="bed" value="{{ old('bed', $house?->bed) }}"
        required min="1" max="125">
      @error('bed')
        <small class="text-danger fw-bold">
          {{ $message }}
        </small>
      @enderror
    </div>

    {{-- mq --}}
    <div class="col-6 mb-3">
      <label for="square_meters" class="form-label">Metri Quadri</label>
      <input name="square_meters" type="number" placeholder="Inserisci i metri quadri"
        class="form-control @error('square_meters') is-invalid @enderror" id="square_meters"
        value="{{ old('square_meters', $house?->square_meters) }}">
      @error('square_meters')
        <small class="text-danger fw-bold">
          {{ $message }}
        </small>
      @enderror
    </div>

    {{-- visibilità --}}
    <div class="col-6 align-content-center">
      <label for="is_visible" class="form-label m-0 pe-2">Visibilità del Castello</label>
      <select name="is_visible" id="is_visible" class="p-1 rounded-2">
        <option @if ($house?->is_visible == 1) selected @endif value="1">Sì</option>
        <option @if ($house?->is_visible == 0) selected @endif value="0">No</option>
      </select>
    </div>

    {{-- Indirizzo --}}
    <div class="col-6 mb-3">
      <label for="address" class="form-label">Indirizzo (*)</label>
      <input type="text" name="address" id="address" placeholder="Inserisci l'indirizzo" class="form-control"
        value="{{ old('address', $house?->address) }}" required min="2" max="100">
      <div id="addressList" role="button" class="autocomplete-items rounded-bottom-3 overflow-hidden"></div>
    </div>

    <input name="latitude" type="hidden" id="latitude" value="{{ old('latitude', $house?->latitude) }}" required
      min="-90" max="90">

    <input name="longitude" type="hidden" id="longitude" value="{{ old('longitude', $house?->longitude) }}" required
      min="-180" max="180">

    {{-- descrizione  --}}
    <div class="col-6 mb-3">
      <label for="description" class="form-label">Descrizione</label>
      <textarea name="description" placeholder="Inserisci una descrizione"
        class="form-control @error('description') is-invalid @enderror" id="description" rows="15">{{ old('description', $house?->description) }}</textarea>
      @error('description')
        <small class="text-danger fw-bold">
          {{ $message }}
        </small>
      @enderror
    </div>

    {{-- servizi --}}
    <div class="btn-group col-6 d-block" role="group" aria-label="Basic checkbox toggle button group">
      <p class="pe-2">Seleziona i Servizi:</p>
      <div class="d-flex flex-wrap">
        @foreach ($services as $service)
          <input type="checkbox" value="{{ $service->id }}" name="services[]" class="btn-check"
            id="tech-{{ $service->id }}" autocomplete="off" @if (($errors->any() && in_array($service->id, old('services', []))) || $house?->services->contains($service)) checked @endif>
          <label class="btn btn-light btn-outline-primary fw-medium m-2"
            for="tech-{{ $service->id }}">{{ $service->name }} <i class="{{ $service->icon }} ms-1"></i></label>
        @endforeach
      </div>
    </div>

    {{-- img  --}}
    <div class="col-6 mb-3">
      <label for="images" class="form-label">Immagini</label>
      <input type="file" value="{{ old('images', $house?->images) }}"
        class="form-control @error('images.*') is-invalid @enderror" id="images" name="images[]" multiple
        onchange="showImage(event)">
      @error('images.*')
        <small class="text-danger fw-bold">{{ $message }}</small>
      @enderror
    </div>

    {{-- FIXME: si può caricare solo una img  --}}

    <div id="image-preview" class="col-12 mb-3">
      <!-- Anteprime delle immagini selezionate verranno inserite qui -->
      <img class="thumb img-thumbnail w-25 my-2" onerror="this.src='/img/not-found.jpg'" id="thumb"
        src="{{ asset('storage/' . $house?->images->first()?->image_path) }}">
      {{-- modificato il percorso per far vedere in anteprima l'immagine se presente appare se non è presente ne appare una di default --}}
    </div>

    <div class="text-center pt-3">
      {{-- passo dinamicamente la classe in base alla rotta  --}}
      <button type="submit"
        class="btn w-25 me-3 {{ Route::currentRouteName() === 'admin.houses.create' ? 'btn-success' : 'btn-warning' }}">{{ $button }}</button>
      <button type="reset" class="btn btn-danger w-25">Reset</button>
    </div>
  </form>

  {{-- javascript  --}}
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const addressInput = document.getElementById('address');
      const addressList = document.getElementById('addressList');
      const latitudeInput = document.getElementById('latitude');
      const longitudeInput = document.getElementById('longitude');

      let addressSelected = @json($isEdit);

      addressInput.addEventListener('input', function() {
        let query = this.value;
        addressSelected = false;

        if (query.length > 1) {
          // Richiamo la rotta
          fetch('{{ route('autocomplete') }}?query=' + encodeURIComponent(query))
            .then(response => response.json())
            .then(data => {
              // Pulisce la lista
              addressList.innerHTML = '';

              data.forEach(item => {
                const option = document.createElement('div');
                option.classList.add('bg-white', 'p-1', 'ps-2', 'border-bottom', 'border-secondary-subtle')
                option.innerHTML = "<strong>" + item.address.freeformAddress + "</strong>";

                // Quando si clicca su un elemento viene impostato come valore dell'input
                option.addEventListener('click', function() {
                  addressInput.value = item.address.freeformAddress;
                  latitudeInput.value = item.position.lat;
                  longitudeInput.value = item.position.lon;
                  addressList.innerHTML = '';
                  addressSelected = true;
                });

                addressList.appendChild(option);
              });
            });
        } else {
          // Se la query è vuota, svuota la lista
          addressList.innerHTML = '';
        }
      });

      // Chiude la lista dei suggerimenti cliccando altrove sulla pagina
      document.addEventListener('click', function(e) {
        if (!addressList.contains(e.target) && e.target !== addressInput) {
          addressList.innerHTML = '';
          console.log({{ $isEdit }});
        }
      });

      function showImage(event) {
        const imagePreviewContainer = document.getElementById('image-preview');
        imagePreviewContainer.innerHTML = ''; // Reset del contenuto

        // Mostra anteprima di tutte le immagini selezionate
        for (let i = 0; i < event.target.files.length; i++) {
          const file = event.target.files[i];
          const imgElement = document.createElement('img');
          imgElement.className = 'thumb w-25 mb-5';
          imgElement.src = URL.createObjectURL(file);
          imagePreviewContainer.appendChild(imgElement);
        }
      }

      document.getElementById('houseForm').addEventListener('submit', function(event) {
        let valid = true;

        // Campi obbligatori
        const title = document.getElementById('title').value;
        const rooms = document.getElementById('rooms').value;
        const bathrooms = document.getElementById('bathrooms').value;
        const bed = document.getElementById('bed').value;
        const address = document.getElementById('address').value;

        // Validazione immagini
        const images = document.getElementById('images').files;
        const validImageTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml'];

        for (let i = 0; i < images.length; i++) {
          if (!validImageTypes.includes(images[i].type)) {
            alert('I file selezionati devono essere di tipo jpeg, png, jpg, gif o svg');
            valid = false;
            break;
          }
        }

        // Controlla se i campi sono validi
        if (title.length < 3 || title.length > 100) {
          alert('Il titolo deve contenere tra 3 e 100 caratteri');
          valid = false;
        }
        if (rooms < 1) {
          alert('Il numero di stanze deve essere almeno 1');
          valid = false;
        }
        if (bathrooms < 1) {
          alert('Il numero di bagni deve essere almeno 1');
          valid = false;
        }
        if (bed < 1) {
          alert('Il numero di letti deve essere almeno 1');
          valid = false;
        }
        if (!address || address.length < 2 || address.length > 100 || addressSelected === false) {
          alert('L\'indirizzo inserito non é valido. Per favore, seleziona un indirizzo dalla lista');
          valid = false;
        }

        // Se non è valido, prevenire l'invio del form
        if (!valid) {
          event.preventDefault();
        }
      });
    })
  </script>

@endsection
