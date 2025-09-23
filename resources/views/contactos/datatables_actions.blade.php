@can('Ver Contactos')
    <a href="{{ route('contactos.show', $id) }}" data-toggle="tooltip" title="Ver" class="mx-2">
        <i class="fa fa-eye text-primary" ></i>
    </a>
    @endcan

@can('Editar Contactos')
    <a href="{{ route('contactos.edit', $id) }}" data-toggle="tooltip" title="Editar" class="mx-2" >
        <i class="fa fa-edit text-warning"></i>
    </a>
@endcan

@can('Eliminar Contactos')
    <a href="#" onclick="deleteItemDt(this)"  data-id="{{ $id }}" data-toggle="tooltip" title="Eliminar" class="mx-2">
        <i class="fa fa-trash-alt text-danger"></i>
    </a>


    <form action="{{ route('contactos.destroy', $id) }}" method="POST" id="delete-form{{ $id }}">
        @method('DELETE')
        @csrf
    </form>
@endcan

