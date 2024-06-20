@extends('layouts.app')

@section('content')
    <div class="container mt-4 log-container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-danger ">{{ __('Register') }}</div>

                    <div class="card-body login-register text-white">
                        <form method="POST" action="{{ route('register') }}" onsubmit="return matchPassword()">
                            @csrf

                            {{-- Nome --}}
                            <div class="mb-4 row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Nome</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required min="3" max="100"
                                        autocomplete="name" autofocus>

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
                                    <input id="surname" type="text"
                                        class="form-control @error('surname') is-invalid @enderror" name="surname"
                                        value="{{ old('surname') }}" required min="3" max="100"
                                        autocomplete="surname" autofocus>

                                    @error('surname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Data di nascita --}}
                            <div class="mb-4 row">
                                <label for="birth_date" class="col-md-4 col-form-label text-md-right">Data di
                                    nascita</label>

                                <div class="col-md-6">
                                    <input id="birth_date" type="date"
                                        class="form-control @error('birth_date') is-invalid @enderror" name="birth_date"
                                        value="{{ old('birth_date') }}" required autocomplete="birth_date" autofocus>


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
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

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
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">
                                    <small id="password-error" class="text-white p-3 rounded-2 text-center w-75"
                                        style="display: none;background-color:#42414D;font-size: 0.75rem"></small>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- conferma password  --}}
                            <div class="mb-4 row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Conferma
                                    Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                    {{-- <small id="password-confirm-error" class="text-white  p-3 rounded-2 text-center w-75"
                                        style="display: none;background-color:#42414D;font-size: 0.75rem"></small> --}}
                                </div>
                            </div>

                            {{-- reCAPTCHA --}}
                            <div class="mb-4 row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site') }}"></div>
                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- btn submit  --}}
                            <div class="mb-4 row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-log">
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

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

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



        function matchPassword() {
            const password = document.getElementById("password").value;
            const passwordConfirm = document.getElementById("password-confirm").value;

            // Espressione regolare con tutte le regole per la validazione lato client della password (almeno una lettera minuscola, maiuscola, un numero, un carattere speciale)
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/;

            // creiamo un'array per i messaggi
            let messages = [];

            // Se la password non contiene almento 8 caratteri pushamo nell'array messages un messaggio di errore
            if (password.length < 8) {
                messages.push('Le password deve contenere almeno 8 caratteri');
            }

            // Se password e password-confirm non coincidono pushamo nell'array messages un messaggio di errore
            if (password !== passwordConfirm) {
                messages.push('Le password non corrispondono');
            }

            // Se il metodo test() della Regex non trova corrispondenza tra la password e le regole di validazione dell'espressione regolare pusha nell'array un messaggio dedicato
            if (!passwordRegex.test(password)) {
                messages.push(
                    'La password deve contenere almeno una lettera maiuscola, una lettera minuscola, un carattere speciale e un numero'
                );
            }

            // 1. Se nell'array sono presenti messaggi di errore assegna display block ai tag small
            // 2. Concatena i messaggiscrivendoli all'interno di password-error e confirm-error prevenendo l'invio del form
            // 3. Se nell'array non sono presenti messaggi permette l'invio del form

            if (messages.length > 0) {
                document.getElementById("password-error").style.display = 'block';
                // document.getElementById("password-confirm-error").style.display = 'block';
                document.getElementById("password-error").textContent = messages.join('. ');
                // document.getElementById("password-confirm-error").textContent = messages.join('. ');
                return false; // Previene l'invio del form
            } else {
                document.getElementById("password-error").style.display = 'none';
                // document.getElementById("password-confirm-error").style.display = 'none';
                document.getElementById("password-error").textContent = '';
                // document.getElementById("password-confirm-error").textContent = '';
                return true; // Permette l'invio del form
            }
        }
    </script>
@endsection
