<div class="aside-bar pt-3">
  <nav>
    <ul>
      <li class="my-4 {{Route::currentRouteName() === 'admin.home' ? 'activeAside' : ''}}">
        <a class="text-decoration-none" href="{{ route('admin.home') }}">
          <i class="fa-solid fa-house me-2"></i>
          <span class="d-none d-md-inline-block"> Home </span>
        </a>
      </li>
      <li class="my-4 {{Route::currentRouteName() === 'admin.houses.create' ? 'activeAside' : ''}}">
        <a class="text-decoration-none" href="{{ route('admin.houses.create') }}">
          <i class="fa-solid fa-circle-plus me-2"></i>
          <span class="d-none d-md-inline-block"> Nuovo Castello </span>
        </a>
      </li>
      <li class="my-4 {{Route::currentRouteName() === 'admin.houses.index' ? 'activeAside' : ''}}">
        <a href="{{ route('admin.houses.index') }}">
          <i class="fa-brands fa-fort-awesome me-2"></i>
          <span class="d-none d-md-inline-block"> Castelli </span>
        </a>
      </li>
      <li class="my-4 {{Route::currentRouteName() === 'admin.messages.index' ? 'activeAside' : ''}}">
        <a href="{{ route('admin.messages.index') }}">
          <i class="fa-solid fa-message me-2"></i>
          <span class="d-none d-md-inline-block"> Messaggi </span>
        </a>
      </li>
      <li class="my-4 {{Route::currentRouteName() === 'admin.deleted' ? 'activeAside' : ''}}">
        <a href="{{ route('admin.deleted') }}">
          <i class="fa-solid fa-trash-arrow-up me-2"></i>
          <span class="d-none d-md-inline-block"> Castelli cancellati </span>
        </a>
      </li>
    </ul>
  </nav>
</div>
