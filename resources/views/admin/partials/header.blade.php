<header>

  <nav class="navbar navbar-expand-lg bg-body-tertiary header-admin">
    <div class="container-fluid">

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <li class="nav-item">
            {{-- faccio aprire sulla stessa pagina --}}
            <a class="nav-link" target="" href="{{url('http://localhost:5174/')}}">
                Home Pubblica
            </a>
          </li>

        </ul>

        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item text-capitalize">
            <span class="nav-link text-white fw-bold user">
            {{ Auth::user()->name}} {{ Auth::user()->surname }}</span>
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
