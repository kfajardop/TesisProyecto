@extends('layouts.app')

@section('titulo_pagina',__('Home'))

@include('layouts.plugins.jquery-ui')

@section('content')

    <div id="root">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-12 col-lg-10 mx-auto">

                        {{-- Tarjeta de bienvenida --}}
                        <div class="card welcome-card mb-4">
                            <div class="row g-0 align-items-center">

                                <div class="col-md-9">
                                    <div class="card-body p-4 p-md-5 text-center text-md-start">

                                        <h2 class="fw-bold mb-2 text-dark">¡Bienvenido {{ auth()->user()->name }}!</h2>

                                        <p class="mb-4">
                                            Cada acción que realices aquí fortalecerá tu labor como
                                            <span class="text-primary">defensor de la justicia</span>
                                            y garante de los derechos de tus clientes.
                                        </p>
                                        <blockquote class="blockquote text-secondary fst-italic mb-0">
                                            “El derecho se aprende estudiando, pero se ejerce pensando.”
                                            <footer class="blockquote-footer mt-1">Eduardo Couture</footer>
                                        </blockquote>
                                    </div>
                                </div>

                                <div class="col-md-2 d-flex justify-content-end align-items-center pe-md-4">
                                    <img src="https://i.pinimg.com/736x/15/ee/a4/15eea4a00cd987de4a9814a92e57c677.jpg"
                                         alt="Justicia"
                                         class="img-fluid rounded-circle shadow"
                                         style="max-width: 160px; height: 160px; object-fit: cover;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('styles')
        <style>
            .welcome-card {
                border: 1px solid #eef0f3;
                border-left: 6px solid #0d6efd;
                border-radius: 14px;
                box-shadow: 0 10px 24px rgba(0,0,0,.06);
                transition: transform .25s ease, box-shadow .25s ease;
                background: #fff;
            }
            .welcome-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 16px 32px rgba(0,0,0,.08);
            }

        </style>
@endpush
