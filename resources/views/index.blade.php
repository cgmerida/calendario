<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel</title>
	<link href="{{ mix('/css/app.css') }}" rel="stylesheet"> 
</head>
<body>
    
    <div class="row">
        <div class="col-12 text-center mt-5">
            <h2>Finalizacion del video</h2>
        </div>
    </div>

    <ul>
        <li><a href="{{ route('miPagina') }}">Mi enlace</a></li>
        <li><a href="{{ route('miPagina') }}">Mi enlace</a></li>
        <li><a href="{{ route('miPagina') }}">Mi enlace</a></li>
        <li><a href="{{ route('miPagina') }}">Mi enlace</a></li>
        <li><a href="{{ route('miPagina') }}">Mi enlace</a></li>
    </ul>

    <script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>