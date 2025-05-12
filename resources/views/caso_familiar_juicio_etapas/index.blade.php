@extends('layouts.app')

@section('titulo_pagina', 'Caso Familiar Juicio Etapas')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header px-4">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Etapas de Juicios</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">
                            <a class="btn btn-primary"
                               href="{{ route('casoFamiliarJuicioEtapas.create') }}">
                                <i class="fa fa-plus"></i>
                                <span class="d-none d-sm-inline">Nueva Etapa</span>
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
            <div class="card card-primary" style="box-shadow: 0 2px 20px rgba(0, 0, 0, 0.25);
            border-radius: 8px; margin: 1rem;">

            <div class="card-body">

                    @include('caso_familiar_juicio_etapas.table')

                </div>
            </div>
            <div class="text-center">

            </div>
        </div>
    </div>



@endsection
