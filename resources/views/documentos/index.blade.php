@extends('layouts.app')

@section('titulo_pagina', 'Documentos')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Documentos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">
                            <a class="btn btn-outline-success"
                               href="{{ route('documentos.create') }}">
                                <i class="fa fa-plus"></i>
                                <span class="d-none d-sm-inline">Nuevo</span>
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="content">
        <div class="container-fluid">
            <div class="clearfix"></div>

            <div class="clearfix"></div>
            <div class="card card-primary">
                <div class="card-body">

                    @include('documentos.table')

                </div>
            </div>
            <div class="text-center">

            </div>
        </div>
        <div class="modal fade" id="modal-create-token">
            <div class="modal-dialog modal-xl">
                <form action="{{route('documentos.cambiar.estado')}}" method="post">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">
                                Cambiar de Estado el documento: @{{ documento?.id }}
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    <label for="tipo_id">Estado Actual:</label>
                                    <multiselect
                                        v-model="estadoActual"
                                        :options="estadosDocumento"
                                        :multiple="false"
                                        label="nombre"
                                        track-by="id"
                                        disabled
                                        :preselect-first="false">
                                    </multiselect>
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="tipo_id">Nueva Estado:</label>
                                    <multiselect
                                        v-model="estadoDocumento"
                                        :options="estadosSinEstadoActual"
                                        :multiple="false"
                                        placeholder="Selecciona un estado"
                                        label="nombre"
                                        track-by="id"
                                        :preselect-first="false">
                                    </multiselect>
                                    <input type="hidden" name="nuevo_estado_id"
                                           :value="estadoDocumento ? estadoDocumento.id : ''" v-if="estadoDocumento">
                                </div>

                                <div class="form-group col-sm-12">
                                    <label for="tipo_id">Observaciones:</label>
                                    <textarea
                                        class="form-control"
                                        rows="3"
                                        placeholder="Observaciones"
                                        name="observaciones"
                                    ></textarea>
                                </div>
                                <input type="hidden" :value="documento?.id" name="documento_id">
                            </div>
                        </div>

                        <!-- Modal Actions -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                <i class="fa fa-ban"></i>
                                Close
                            </button>

                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-save"></i>
                                Cambiar de Estado
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>

        function mostrarModalCambiarEstado(documento) {
            console.log(documento)
            app.documento = documento;
            $('#modal-create-token').modal('show');
        }

        const app = new Vue({
            el: '#modal-create-token',
            data: {
                documento: null,
                estadosDocumento: @json(\App\Models\DocumentoEstado::all()),
                estadoDocumento: null,


                nuevaEtapa: null,

                idCasoFamiliar: @json(\App\Models\CasoTipo::FAMILIAR),
                idCasoPenal: @json(\App\Models\CasoTipo::PENAL),
            },
            mounted() {
            },
            computed: {
                estadoActual() {
                    return this.documento ? this.documento.estado : null;
                },
                estadosSinEstadoActual() {
                    return this.estadosDocumento.filter(estado => estado.id !== this.estadoActual?.id);
                },
            },
        });
    </script>
@endpush
