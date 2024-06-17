@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" >
                        @csrf

                        {{-- Nome --}}
                        <div class="mb-4 row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nome</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required min="3" max="100" autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        {{-- Cognome --}}
                        <div class="mb-4 row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">Cognome</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required min="3" max="100" autocomplete="surname" autofocus>

                                @error('surname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        {{-- Data di nascita --}}
                        <div class="mb-4 row">
                            <label for="birth_date" class="col-md-4 col-form-label text-md-right">Data di nascita</label>

                            <div class="col-md-6">
                                <input id="birth_date" type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" value="{{ old('birth_date') }}" required autocomplete="birth_date" autofocus>


                                {{-- @if (!validateForm)
                                    <small>
                                        Devi avere almeno 18 anni
                                    </small>
                                @endif --}}
                            </div>
                        </div>



                        {{-- Email  --}}
                        <div class="mb-4 row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- password  --}}
                        <div class="mb-4 row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- conferma password  --}}
                        <div class="mb-4 row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Conferma Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        {{-- btn submit  --}}
                        <div class="mb-4 row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrati
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

        //     function validateForm() {
        //     const birthDate = new Date(document.getElementById("birth_date").value);
        //     const today = new Date();
        //     const age = today.getFullYear() - birthDate.getFullYear();
        //     const isAdult = (age > 18) || (age === 18 && today.getMonth() >= birthDate.getMonth() && today.getDate() >= birthDate.getDate());

        //     if (!isAdult) {
        //         return false ;
        //     }
        //     return true;
        // }
        //         // Funzione per calcolare la data di 18 anni fa da oggi
        //     function calculateMaxDate() {
        //     const today = new Date();
        //     const eighteenYearsAgo = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());
        //     const maxDate = eighteenYearsAgo.toISOString().split('T')[0]; // Converte in formato AAAA-MM-GG
        //     return maxDate;
        // }

        // // Imposta l'attributo max per l'input di tipo date
        // document.getElementById('birth_date').setAttribute('max', calculateMaxDate());

</script>




@endsection
