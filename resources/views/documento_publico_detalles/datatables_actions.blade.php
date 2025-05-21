@can('Ver Documento Publico Detalles')
    <a href="{{ route('documentoPublicoDetalles.show', $id) }}" data-toggle="tooltip" title="Ver" class='btn btn-sm btn-outline-secondary'>
        <i class="fa fa-eye"></i>
    </a>
    @endcan

@can('Editar Documento Publico Detalles')
    <a href="{{ route('documentoPublicoDetalles.edit', $id) }}" data-toggle="tooltip" title="Editar" class='btn btn-sm btn-outline-info'>
        <i class="fa fa-edit"></i>
    </a>
@endcan

@can('Eliminar Documento Publico Detalles')
    <a href="#" onclick="deleteItemDt(this)" data-id="{{ $id }}" data-toggle="tooltip" title="Eliminar" class='btn btn-sm btn-outline-danger'>
        <i class="fa fa-trash-alt"></i>
    </a>


    <form action="{{ route('documentoPublicoDetalles.destroy', $id) }}" method="POST" id="delete-form{{ $id }}">
        @method('DELETE')
        @csrf
    </form>
@endcan

