<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Landing page of Calendar RN">
    <meta name="author" content="Gerardo Merida">

    <title>Calendario RN</title>

    <!-- Styles -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

    <style>
        @media screen and (max-width: 992px) {
            .masthead h1 {
                font-size: 5.5rem;
            }
        }

        .masthead {
            min-height: 30rem;
            position: relative;
            display: table;
            width: 100%;
            height: 100vh;
            padding-top: 8rem;
            padding-bottom: 8rem;
            background: -webkit-gradient(linear, left top, right top, from(rgba(255, 255, 255, .1)), to(rgba(255, 255, 255, .1))),
            url('{{ asset("/images/arte.jpg") }}');
            background: linear-gradient(90deg,
            rgba(255, 255, 255, .1) 0,
            rgba(255, 255, 255, .1) 100%),
            url('{{ asset("/images/arte.jpg") }}');
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
            color: #212529;
        }

        .masthead h1 {
            font-size: 4rem;
            margin: 0;
            padding: 0;
        }

        .btn {
            -webkit-box-shadow: 0 3px 3px 0 rgba(0, 0, 0, .1);
            box-shadow: 0 3px 3px 0 rgba(0, 0, 0, .1);
            font-weight: 700;
        }

        .btn-primary {
            background-color: #1d809f!important;
            border-color: #1d809f!important;
            color: #fff!important;
        }

        .btn-xl {
            padding: 1.25rem 2.5rem;
        }
    </style>

</head>

<body>

    <div class="masthead d-flex">
        <div class="container text-center my-auto fw-900">
            <h1 class="mb-1">Calendario RN</h1>
            <h3 class="mb-5">
                <em>Un sistema de organización municipal</em>
            </h3>
            @auth
            <a class="btn btn-primary btn-xl js-scroll-trigger" href="/admin">Inicio</a> @else
            <a class="btn btn-primary btn-xl js-scroll-trigger" href="/login">Iniciar Sesión</a> @endauth
        </div>
    </div>

    <script src="{{ mix('/js/app.js') }}"></script>

</body>

</html>