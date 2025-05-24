@can('Ver Documentos')
    <a href="{{ route('documentos.show', $id) }}" data-toggle="tooltip" title="Ver" class='btn btn-sm btn-outline-secondary'>
        <i class="fa fa-eye"></i>
    </a>
    @endcan


@can('Editar Documentos')
    <a href="{{ route('documentos.edit', $id) }}" data-toggle="tooltip" title="Editar" class='btn btn-sm btn-outline-info'>
        <i class="fa fa-edit"></i>
    </a>
@endcan

@can('Cambiar Estado Documentos')
    <a
        data-toggle="tooltip"
        title="Cambiar Etapa"
        class='btn btn-sm btn-outline-warning'
        onclick="mostrarModalCambiarEstado({{ $documento }})"
    >
        <i class="fas fa-exchange-alt"></i>

    </a>
@endcan

@can('Eliminar Documentos')
    <a href="#" onclick="deleteItemDt(this)" data-id="{{ $id }}" data-toggle="tooltip" title="Eliminar" class='btn btn-sm btn-outline-danger'>
        <i class="fa fa-trash-alt"></i>
    </a>


    <form action="{{ route('documentos.destroy', $id) }}" method="POST" id="delete-form{{ $id }}">
        @method('DELETE')
        @csrf
    </form>
@endcan

