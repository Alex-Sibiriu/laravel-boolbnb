<div class="aside-bar pt-3">
  <nav>
    <ul>
      <li class="my-4">
        <a class="text-decoration-none" href="{{ route('admin.home') }}">
          <i class="fa-solid fa-house me-2"></i>
          Home
        </a>
      </li>
      <li class="my-4">
        <a class="text-decoration-none" href="{{ route('admin.houses.create') }}">
          <i class="fa-solid fa-circle-plus me-2"></i>
          Nuovo Castello
        </a>
      </li>
      <li>
        <a href="{{ route('admin.houses.index') }}">
          <i class="fa-brands fa-fort-awesome me-2"></i>
          Castelli
        </a>
      </li>
      <li>
        <a href="">
          <i class="fa-solid fa-money-bill-wave me-2"></i>
          Sponsor
        </a>
      </li>
      <li>
        <a href="{{ route('admin.messages.index') }}">
          <i class="fa-solid fa-message me-2"></i>
          Messaggi
        </a>
      </li>
      <li>
        <a href="{{ route('admin.deleted') }}">
          <i class="fa-solid fa-trash-arrow-up me-2"></i>
          Castelli cancellati
        </a>
      </li>
    </ul>
  </nav>
</div>
