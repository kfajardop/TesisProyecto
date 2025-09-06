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

    <div class="content" id="modal-create-token">
        <div class="container-fluid">
            <div class="clearfix"></div>

            <div class="card" id="filtros">
                <div class="card-header" data-toggle="collapse" data-target="#filtros-card" style="cursor: pointer;">
                    <h4 class="card-title">Filtros</h4>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#filtros-card">
                            <i class="fa fa-filter"></i>
                        </button>
                    </div>
                </div>
                <div id="filtros-card"
                     class="collapse {{ request()->hasAny(['rango_fechas', 'estados_id', 'nombre']) ? 'show' : '' }}">
                    <div class="card-body">
                        <form id="form-filtros" method="GET" action="{{ route('documentos.index') }}">
                            <div class="form-row">

                                {{--                                <!-- Filtro Rango de Fechas -->--}}
                                <div class="form-group col-sm-6">
                                    <label>Rango Fecha:</label>
                                    <input
                                        type="text"
                                        id="rango_fechas"
                                        name="rango_fechas"
                                        class="form-control"
                                        value="{{ old('rango_fechas', request('rango_fechas', '')) }}"
                                    >
                                </div>

                                <!-- Filtro Casos -->
                                <div class="form-group col-sm-6">
                                    <label for="casos">Estados:</label>
                                    <multiselect
                                        v-model="filtroEstado"
                                        :options="estadosDocumento"
                                        :multiple="true"
                                        placeholder="Seleccione uno o varios estados"
                                        label="nombre"
                                        track-by="id"
                                    >
                                    </multiselect>
                                    <input type="hidden" name="estados_id[]" v-for="estado in filtroEstado" :value="estado.id">
                                </div>

                                <!-- Filtro Nombre -->
                                <div class="form-group col-sm-6">
                                    <label for="nombre">Nombre de Persona Involucrada:</label>
                                    <input
                                        name="nombre"
                                        type="text"
                                        class="form-control"
                                        placeholder="Ingrese nombre de la persona involucrada"
                                        value="{{ request('nombre') }}"
                                    >
                                </div>
                            </div>

                            <div class="text-right">
                                <a href="{{ route('documentos.index') }}" class="btn btn-secondary mr-2">
                                    <i class="fa fa-eraser"></i> Limpiar
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-search"></i> Aplicar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
                filtroEstado: @json(
    old('estados_id')
        ? \App\Models\DocumentoEstado::whereIn('id', old('estados_id'))->get()
        : (request()->filled('estados_id')
            ? \App\Models\DocumentoEstado::whereIn('id', request('estados_id'))->get()
            : [])
),

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

        var rangoFechas = $('#rango_fechas').val();
        var fechaInicio = moment().startOf('month');
        var fechaFin = moment();

        if (rangoFechas) {
            var fechas = rangoFechas.split(' - ');
            fechaInicio = moment(fechas[0], 'DD/MM/YYYY');
            fechaFin = moment(fechas[1], 'DD/MM/YYYY');
        }

        $('input[name="rango_fechas"]').daterangepicker({
            timePicker: true,
            timePicker24Hour: false,
            startDate: fechaInicio,
            endDate: fechaFin,
            locale: {
                format: 'DD/MM/YYYY',
                applyLabel: 'Aplicar',
                cancelLabel: 'Cancelar',
                fromLabel: 'Desde',
                toLabel: 'Hasta',
                customRangeLabel: 'Rango personalizado',
                weekLabel: 'S',
                daysOfWeek: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
                monthNames: [
                    'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                ],
                firstDay: 1
            }
        });
    </script>
@endpush
