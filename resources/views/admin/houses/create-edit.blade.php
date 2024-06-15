@extends('layouts.admin')

@section('content')
  <h1 class="py-5 text-center mt-3 rounded-3 bg-gray">{{ $title }}</h1>

  <form class="row fw-medium rounded-3 bg-gray p-5" enctype="multipart/form-data" action='{{ $route }}' method='POST'>
    @csrf
    @method($method)

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="m-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="col-6 mb-3">
      <label for="title" class="form-label">Titolo (*)</label>
      <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="title"
        value="{{ old('title', $house?->title) }}">
      @error('title')
        <small class="text-danger fw-bold">
          {{ $message }}
        </small>
      @enderror
    </div>

    <div class="col-6 mb-3">
      <label for="rooms" class="form-label">Stanze (*)</label>
      <input name="rooms" type="number" class="form-control @error('rooms') is-invalid @enderror" id="rooms"
        value="{{ old('rooms', $house?->rooms) }}">
      @error('rooms')
        <small class="text-danger fw-bold">
          {{ $message }}
        </small>
      @enderror
    </div>

    <div class="col-6 mb-3">
      <label for="bathrooms" class="form-label">Bagni (*)</label>
      <input name="bathrooms" type="number" class="form-control @error('bathrooms') is-invalid @enderror" id="bathrooms"
        value="{{ old('bathrooms', $house?->bathrooms) }}">
      @error('bathrooms')
        <small class="text-danger fw-bold">
          {{ $message }}
        </small>
      @enderror
    </div>

    <div class="col-6 mb-3">
      <label for="bed" class="form-label">Posti Letto (*)</label>
      <input name="bed" type="number" class="form-control @error('bed') is-invalid @enderror" id="bed"
        value="{{ old('bed', $house?->bed) }}">
      @error('bed')
        <small class="text-danger fw-bold">
          {{ $message }}
        </small>
      @enderror
    </div>

    <div class="col-6 mb-3">
      <label for="square_meters" class="form-label">Metri Quadri</label>
      <input name="square_meters" type="number" class="form-control @error('square_meters') is-invalid @enderror"
        id="bed" value="{{ old('square_meters', $house?->square_meters) }}">
      @error('square_meters')
        <small class="text-danger fw-bold">
          {{ $message }}
        </small>
      @enderror
    </div>

    <div class="col-6 align-content-center">
      <label for="is_visible" class="form-label m-0 pe-2">Visibilità del Castello</label>
      <select name="is_visible" id="is_visible" class="p-1 rounded-2">
        <option value="1">Si</option>
        <option value="0">No</option>
      </select>
    </div>

    <div class="col-2 mb-3">
      <label for="latitude" class="form-label">Latitudine (*)</label>
      <input name="latitude" type="number" class="form-control @error('latitude') is-invalid @enderror" id="latitude"
        value="{{ old('latitude', $house?->latitude) }}">
      @error('latitude')
        <small class="text-danger fw-bold">
          {{ $message }}
        </small>
      @enderror
    </div>

    <div class="col-2 mb-3">
      <label for="longitude" class="form-label">Latitudine (*)</label>
      <input name="longitude" type="number" class="form-control @error('longitude') is-invalid @enderror" id="longitude"
        value="{{ old('longitude', $house?->latitude) }}">
      @error('longitude')
        <small class="text-danger fw-bold">
          {{ $message }}
        </small>
      @enderror
    </div>

    <div class="col-8 mb-3">
      <label for="address" class="form-label">Indirizzo</label>
      <input name="address" type="text" class="form-control @error('address') is-invalid @enderror" id="address"
        value="{{ old('address', $house?->address) }}">
      @error('address')
        <small class="text-danger fw-bold">
          {{ $message }}
        </small>
      @enderror
    </div>

    <div class="col-6 mb-3">
      <label for="description" class="form-label">Descrizione</label>
      <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description"
        rows="15">{{ old('description', $house?->description) }}</textarea>
      @error('description')
        <small class="text-danger fw-bold">
          {{ $message }}
        </small>
      @enderror
    </div>

    <div class="btn-group col-6 d-block" role="group" aria-label="Basic checkbox toggle button group">
      <p class="pe-2">Seleziona i Servizi:</p>
      <div class="dflex">
        @foreach ($services as $service)
          <input type="checkbox" value="{{ $service->id }}" name="technologies[]" class="btn-check"
            id="tech-{{ $service->id }}" autocomplete="off" @if (($errors->any() && in_array($service->id, old('technologies', []))) || $house?->services->contains($service)) checked @endif>

          <label class="btn btn-light btn-outline-primary fw-medium m-2"
            for="tech-{{ $service->id }}">{{ $service->name }} <i class="{{ $service->icon }} ms-1"></i></label>
        @endforeach
      </div>
    </div>

    <div class="text-center pt-3">
      <button type="submit" class="btn btn-primary w-25 me-3">Invia</button>
      <button type="reset" class="btn btn-warning w-25">Reset</button>
    </div>
  </form>

  <script>
    function showImage(event) {
      const image = document.getElementById('thumb-img');
      image.src = URL.createObjectURL(event.target.files[0]);
    }
  </script>
@endsection