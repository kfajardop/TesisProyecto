@can('Ver Tareas')
    <a href="{{ route('tareas.show', $id) }}" data-toggle="tooltip" title="Ver" class='btn btn-sm btn-outline-primary'>
        <i class="fa fa-eye"></i>
    </a>
    @endcan

@can('Editar Tareas')
    <a href="{{ route('tareas.edit', $id) }}" data-toggle="tooltip" title="Editar" class='btn btn-sm btn-outline-warning'>
        <i class="fa fa-edit"></i>
    </a>
@endcan

@can('Eliminar Tareas')
    <a href="#" onclick="deleteItemDt(this)" data-id="{{ $id }}" data-toggle="tooltip" title="Eliminar" class='btn btn-sm btn-outline-danger'>
        <i class="fa fa-trash-alt"></i>
    </a>


    <form action="{{ route('tareas.destroy', $id) }}" method="POST" id="delete-form{{ $id }}">
        @method('DELETE')
        @csrf
    </form>
@endcan

