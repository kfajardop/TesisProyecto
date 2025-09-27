@can('Ver Tarea Prioridads')
    <a href="{{ route('tareaPrioridads.show', $id) }}" data-toggle="tooltip" title="Ver" class='btn btn-sm btn-outline-primary'>
        <i class="fa fa-eye"></i>
    </a>
    @endcan

@can('Editar Tarea Prioridads')
    <a href="{{ route('tareaPrioridads.edit', $id) }}" data-toggle="tooltip" title="Editar" class='btn btn-sm btn-outline-warning'>
        <i class="fa fa-edit"></i>
    </a>
@endcan

@can('Eliminar Tarea Prioridads')
    <a href="#" onclick="deleteItemDt(this)" data-id="{{ $id }}" data-toggle="tooltip" title="Eliminar" class='btn btn-sm btn-outline-danger'>
        <i class="fa fa-trash-alt"></i>
    </a>


    <form action="{{ route('tareaPrioridads.destroy', $id) }}" method="POST" id="delete-form{{ $id }}">
        @method('DELETE')
        @csrf
    </form>
@endcan

