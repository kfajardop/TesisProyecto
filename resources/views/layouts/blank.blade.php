<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield("titulo_pagina") - {{config('app.name')}} </title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">


    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" type="text/css" />

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <style>
        .background-image {
            position: absolute;
            left: 0;
            top: 0;
            background: url("{{getFondoLogin()}}") no-repeat;
            background-size: cover;
            -moz-background-size: cover;
            -webkit-background-size: cover;
            -o-background-size: cover;
            width: 100%;
            height: 100%;
            -webkit-filter: blur(5px);
            -moz-filter: blur(5px);
            -o-filter: blur(5px);
            -ms-filter: blur(5px);
            filter: blur(5px);
            z-index: -999999;
        }
    </style>


    <style>
        .auth-bg {
            position: fixed;
            inset: 0;
            background: url('https://i.pinimg.com/1200x/45/f4/e3/45f4e34df6aff86516d058862927d1e3.jpg') center/cover no-repeat;
            z-index: -2;
        }

        .auth-bg::before {
            content: "";
            position: absolute;
            inset: 0;
            background-color: rgba(255, 255, 255, 0.55); /* capa blanca con opacidad */
            z-index: -1;
        }


        /* Overlay degradado suave (oscurece un poco para legibilidad) */
        .auth-bg .overlay{
            position:absolute; inset:0;
            background: rgba(0,0,0,.35);
            z-index:-1;
        }

        /* Vignette sutil para que el login destaque */
        .auth-bg .vignette{
            position:absolute; inset:0;
            background: radial-gradient(80% 60% at 50% 55%, rgba(0,0,0,0) 0%, rgba(0,0,0,.18) 100%);
            z-index:-1;
        }

        /* Contenedor que centra el login */
        .center-wrap{
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        /* Tarjeta del login */
        .card{
            border-radius: 14px;
            box-shadow: 0 16px 40px rgba(0,0,0,.22);


        }
        .login-card-body{
            max-width: 480px;
            width: 100%;
            padding: 2.2rem 2.6rem;
            background: #fff;
            border-radius: 14px;
        }

        .quote-wrap{
            position: fixed;
            bottom: 98px;
            left: 50%;
            transform: translateX(-50%);
            max-width: min(1000px, 92vw);   /* no se sale en pantallas pequeñas */
            width: max-content;
            pointer-events: none;
            padding: 0 16px;                /* margen lateral de seguridad */
        }

        .quote{
            color: #f1f1f1;
            font-size: 1.2rem;
            line-height: 1.5;
            text-shadow: 0 2px 6px rgba(0,0,0,.45);
            max-width: 900px;
            font-style: italic;
        }
        .quote small{
            display:block; margin-top: 4px;
            font-style: normal; opacity:.9;
        }


        .btn-primary{
            border-radius: 8px;
            background: linear-gradient(90deg, #0d6efd, #0a58ca);
            border: none;
            transition: transform .15s ease, filter .15s ease;
        }
        .btn-primary:hover{ transform: translateY(-1px); filter: brightness(.98); }

        /* Responsive: en móvil reduce padding y oculta la frase si estorba */
        @media (max-width: 576px){
            .login-card-body{ padding: 1.5rem; }
            .quote{ font-size: 1rem; max-width: 95vw; }
        }

    </style>

</head>
<body class="hold-transition login-page">
        <div class="auth-bg">
            <div class="overlay"></div>
            <div class="vignette"></div>
        </div>


        <div class="quote-wrap">
            <div class="quote">
               <h4>"Los abogados son los arquitectos de la justicia y los guardianes de la libertad."</h4>
                <small>— Robert Kennedy</small>
            </div>
        </div>

        {{-- Login centrado --}}
        <div class="center-wrap">
            <div class="login-shell">
                @yield('content')
            </div>
        </div>

    <script src="{{asset("js/sparkline.js")}}"></script>

    <script src="{{asset("js/moment.min.js")}}"></script>
    <script src="{{ url (mix('/js/app.js')) }}" type="text/javascript"></script>

</body>
</html>

