@extends('layouts.app')

@section('titulo_pagina', 'Audiencias')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Audiencias</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">
                            <a class="btn btn-outline-success"
                               href="{{ route('audiencias.create') }}">
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
                     class="collapse {{ request()->hasAny(['fecha_inicio', 'fecha_fin', 'casos', 'nombre']) ? 'show' : '' }}">
                    <div class="card-body">
                        <form id="form-filtros" method="GET" action="{{ route('audiencias.index') }}">
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
                                    <label for="casos">Casos:</label>
                                    <multiselect
                                        v-model="filtrosCasos"
                                        :options="casosOptions"
                                        :multiple="true"
                                        placeholder="Seleccione uno o varios casos"
                                        label="nombre_caso"
                                        track-by="id">
                                    </multiselect>
                                    <input type="hidden" name="casos_id[]" v-for="caso in filtrosCasos" :value="caso.id">
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
                                <a href="{{ route('audiencias.index') }}" class="btn btn-secondary mr-2">
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

                    @include('audiencias.table')

                </div>
            </div>
            <div class="text-center">

            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        new Vue({
            el: '#filtros',
            data: {
                filtrosCasos: @json(old('casos_id')
                                        ? \App\Models\Caso::whereIn('id', old('casos_id'))->get()
                                        : (request()->filled('casos_id')
                                            ? \App\Models\Caso::whereIn('id', request('casos_id'))->get()
                                            : [])
                                ),
                casosOptions: @json(\App\Models\Caso::all()),
            },
        });

        // Tomamos el valor del input (ya contiene old o request)
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
