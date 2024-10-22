<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/png">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>BollBnB - Dashboard</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  {{-- Font Awesome --}}
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css'
    integrity='sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=='
    crossorigin='anonymous' />

  <!-- Scripts -->
  @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>

<body>

  @guest
    <script>
      window.location.href = "{{ route('login') }}";
    </script>
  @endguest

  @include('admin.partials.header')

  <div class="d-flex">
    @include('admin.partials.aside')

    <div class="main">

      @yield('content')
    </div>
  </div>

</body>

</html>
