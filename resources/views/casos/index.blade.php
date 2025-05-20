@extends('layouts.app')

@section('titulo_pagina', 'Casos')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Casos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">
                            <a class="btn btn-outline-success"
                               href="{{ route('casos.create') }}">
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
                <div class="card-body" id="tabla">

                    @include('casos.table')

                    {{--                    crear aqui el modal --}}

                </div>
            </div>
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
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                <button type="submit" class="btn btn-success">
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
    </script>
@endpush

