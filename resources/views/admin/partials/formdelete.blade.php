<form
  action="{{ $route }}"
  method="POST"
  onsubmit="return confirm('{{ $message }}')"
  class="d-inline-block">

@csrf
@method('DELETE')

<button
  type="submit"
  class="{{Route::currentRouteName() !== 'admin.houses.show' ? 'btn btn-danger': 'm-2'}} @if (Route::currentRouteName() === 'admin.houses.index')
      mb-2
      @elseif (Route::currentRouteName() === 'admin.messages.index')
      mb-2
      @elseif (Route::currentRouteName() === 'admin.orderby')
      mb-2
  @endif "><i
  class="fa-solid fa-trash-can"></i></button>
</form>
