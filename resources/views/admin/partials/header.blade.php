<header>

  <nav class="navbar navbar-expand bg-body-tertiary header-admin">
    <div class="container-fluid">

      <div class=" navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <li class="nav-item">
            {{-- faccio aprire sulla stessa pagina --}}
            <a class="nav-link" target="" href="{{ url('https://vue-boolbnb.vercel.app') }}">
              Home Pubblica
            </a>
          </li>

        </ul>

        <ul class="navbar-nav mb-2 mb-lg-0 ">
          <li class="nav-item text-capitalize dropdown">
            <span class="nav-link text-white fw-bold user dropdown-toggle" id="navbarDropdown" role="button"
              data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              {{ Auth::user()->name }} {{ Auth::user()->surname }}</span>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown ">
              <a class="dropdown-item drop-auth" href="{{ route('admin.home') }}">{{ __('Dashboard') }}</a>
              <a class="dropdown-item drop-auth" href="{{ url('profile') }}">{{ __('Profile') }}</a>
              <a class="dropdown-item drop-auth" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </div>

          </li>

          <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="nav-link text-white">Logout</button>
            </form>
          </li>
        </ul>

      </div>
    </div>
  </nav>

</header>
