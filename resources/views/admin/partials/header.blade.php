<header>


    <nav class="navbar navbar-expand-lg bg-body-tertiary header-admin">
        <div class="container-fluid">

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="">Home</a>
              </li>

              <li class="nav-item">
                {{-- _blanck si usa per aprire una nuova pagina al posto di caricare la stessa pagina --}}
                <a class="nav-link" target="_blank" href="">Go to WebSite</a>
              </li>


            </ul>

            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item ">
                    <span class="nav-link">User: <span class="user">{{ Auth::user()->name }}</span></span>
                </li>

                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link">Logout</button>
                    </form>
                </li>
            </ul>

          </div>
        </div>
    </nav>

</header>
