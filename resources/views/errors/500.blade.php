<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>500 - Error interno del servidor</title>
    <link rel="stylesheet" href="{{  mix('/css/app.css') }}">
</head>
<body class="app">
<div class='pos-a t-0 l-0 bgc-white w-100 h-100 d-f fxd-r fxw-w ai-c jc-c pos-r p-30'>
    <div class='mR-60'>
        <img alt='#' src='{{ asset('/images/500.png') }}'/>
    </div>

    <div class='d-f jc-c fxd-c'>
        <h1 class='mB-30 fw-900 lh-1 c-red-500' style="font-size: 60px;">500</h1>
        <h3 class='mB-10 fsz-lg c-grey-900 tt-c'>Error interno del servidor</h3>
        <p class='mB-30 fsz-def c-grey-700'>Algo fallo en nuestros servidores, por favor intente de nuevo más tarde.</p>
        <div>
            <a href="{{ route('admin.dash') }}" type='primary' class='btn btn-primary'>Ir al inicio</a>
        </div>
    </div>
</div>
</body>
</html>