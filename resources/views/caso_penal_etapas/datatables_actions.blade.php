@can('Ver Caso Penal Etapas')
    <a href="{{ route('casoPenalEtapas.show', $id) }}" data-toggle="tooltip" title="Ver" class='btn btn-sm btn-outline-primary'>
        <i class="fa fa-eye"></i>
    </a>
    @endcan

@can('Editar Caso Penal Etapas')
    <a href="{{ route('casoPenalEtapas.edit', $id) }}" data-toggle="tooltip" title="Editar" class='btn btn-sm btn-outline-warning'>
        <i class="fa fa-edit"></i>
    </a>
@endcan

@can('Eliminar Caso Penal Etapas')
    <a href="#" onclick="deleteItemDt(this)" data-id="{{ $id }}" data-toggle="tooltip" title="Eliminar" class='btn btn-sm btn-outline-danger'>
        <i class="fa fa-trash-alt"></i>
    </a>


    <form action="{{ route('casoPenalEtapas.destroy', $id) }}" method="POST" id="delete-form{{ $id }}">
        @method('DELETE')
        @csrf
    </form>
@endcan

