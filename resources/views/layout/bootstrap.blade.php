<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" href="/img/laravel.png" type="image/x-icon" />
    <link rel="shortcut icon" href="/img/laravel.png" />

    <!-- responsive metatag -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <title>@yield('title', 'WebService PlacetoPay - Redirección-Pago básico')</title>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="<?= url('/') ?>">
            <img src="/img/bootstrap-solid.svg" height="30" width="30" class="d-inline-block align-top" alt="">
            P2P
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" 
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= url('/') ?>">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= url('/formulario') ?>">Formulario</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= url('/transacciones') ?>">Pagos</a>
                </li>
            </ul>
        </div>
    </nav><br />

    <div class="container">
        @yield('content')
    </div>

    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/popper-1.12.9.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/fasterjs.js"></script>

</body>

</html>