@extends('layouts.app')

@section('titulo_pagina', 'Casos')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Casos Legales</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">
                            <a class="btn btn-primary"
                               href="{{ route('casos.create') }}">
                                <i class="fa fa-plus"></i>
                                <span class="d-none d-sm-inline">Nuevo Caso</span>
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="content">
        <div class="container-fluid">
            <div class="clearfix"></div>

            <!-- 🔽 Card Collapsible de Filtros -->
            <div class="card" id="filtros">
                <div class="card-header" data-toggle="collapse" data-target="#filtros-card" style="cursor: pointer;">
                    <h4 class="card-title">Filtros</h4>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#filtros-card">
                            <i class="fa fa-filter"></i>
                        </button>
                    </div>
                </div>
                <div id="filtros-card" class="collapse {{ request()->hasAny(['tipo_id', 'dpi', 'nombre']) ? 'show' : '' }}">
                    <div class="card-body">
                        <form id="form-filtros" method="GET" action="{{ route('casos.index') }}">
                            <div class="form-row">
                                <!-- Filtro Tipo de Caso -->
                                <div class="form-group col-sm-6">
                                    <label for="tipo_caso">Tipo de Caso:</label>
                                    <multiselect
                                        v-model="filtroCasoSeleccionado"
                                        :options="casoTipos"
                                        :multiple="false"
                                        placeholder="Selecciona un tipo de caso"
                                        label="nombre"
                                        track-by="id">
                                    </multiselect>
                                    <input name="tipo_id" type="hidden" :value="filtroCasoSeleccionado?.id">
                                </div>

                                <!-- Filtro Persona Involucrada -->
                                <div class="form-group col-sm-6">
                                    <label for="persona">DPI:</label>
                                    <input name="dpi" type="text" class="form-control"
                                           placeholder="Ingrese DPI de la persona involucrada"
                                           value="{{ request('dpi') }}"
                                    >
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="persona">Nombre:</label>
                                    <input name="nombre" type="text" class="form-control"
                                           placeholder="Ingrese nombre de la persona involucrada"
                                           value="{{ request('nombre') }}"
                                    >
                                </div>
                            </div>

                            <div class="text-right">
                                <a href="{{route('casos.index')}}" class="btn btn-secondary mr-2">
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
            <!-- 🔽 Fin de Filtros -->

            <div class="card card-primary">
                <div class="card-body" id="tabla">
                    @include('casos.table')
                </div>
            </div>

            <!-- Modal existente -->
            <div class="modal fade" id="modal-create-token">
                <div class="modal-dialog modal-xl">
                    <form action="{{route('casos.cambiar.etapa')}}" method="post">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">
                                    Cambiar de Etapa el caso
                                </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                                </button>
                            </div>

                            <div class="modal-body">

                                <div class="form-row">

                                    <div class="form-group col-sm-6">
                                        <label for="tipo_id">Etapa Actual:</label>
                                        <multiselect
                                            v-model="etapaActual"
                                            :options="etapas"
                                            :multiple="false"
                                            placeholder="Selecciona una etapa"
                                            label="nombre"
                                            track-by="id"
                                            disabled
                                            :preselect-first="false">
                                        </multiselect>
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label for="tipo_id">Nueva Etapa:</label>
                                        <multiselect
                                            v-model="nuevaEtapa"
                                            :options="etapaSinEtapaActual"
                                            :multiple="false"
                                            placeholder="Selecciona una etapa"
                                            label="nombre"
                                            track-by="id"
                                            :preselect-first="false">
                                        </multiselect>
                                        <input type="hidden" name="nueva_etapa_id"
                                               :value="nuevaEtapa ? nuevaEtapa.id : ''" v-if="nuevaEtapa">
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
                                    <input type="hidden" :value="caso?.id" name="caso_id">
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
                                    Cambiar de Etapa
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>

        function mostrarModalCambioEtapa(caso) {
            app.caso = caso;
            $('#modal-create-token').modal('show');
        }

        const app = new Vue({
            el: '#modal-create-token',
            data: {
                caso: null,
                etapasCasoPenal: @json(\App\Models\CasoPenalEtapa::all()),
                etapasCasoFamiliar: @json(\App\Models\CasoFamiliarJuicioEtapa::all()),

                nuevaEtapa: null,

                idCasoFamiliar: @json(\App\Models\CasoTipo::FAMILIAR),
                idCasoPenal: @json(\App\Models\CasoTipo::PENAL),
            },
            mounted() {
            },
            methods: {},
            computed: {
                etapas() {
                    if (!this.caso) return [];

                    return this.caso.tipo_id === this.idCasoPenal ? this.etapasCasoPenal : this.etapasCasoFamiliar;
                },
                etapaSinEtapaActual() {
                    if (!this.caso) return [];
                    return this.etapas.filter(etapa => etapa.id !== this.caso.etapa_actual_id);
                },
                etapaActual() {
                    if (!this.caso) return null;
                    return this.etapas.find(etapa => etapa.id === this.caso.etapa_actual_id);
                }
            }
        });

        new Vue({
            el: '#filtros',
            data: {
                casoTipos: @json(\App\Models\CasoTipo::all()),
                filtroCasoSeleccionado: @json(\App\Models\CasoTipo::all()->where('id', request('tipo_id'))->first()),
            },
        });
    </script>
@endpush

