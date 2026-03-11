@if(isset($playUrl))
    <a href="{{ $playUrl }}" class="underline mr-2">Ver Test</a>
@endif

<a href="{{ $editUrl }}" class="underline">Editar</a>

<form method="POST" action="{{ $deleteUrl }}" class="inline"
      onsubmit="return confirm('{{ $confirmMessage }}');">
    @csrf
    @method('DELETE')
    <button class="ml-2 underline">Eliminar</button>
</form>
