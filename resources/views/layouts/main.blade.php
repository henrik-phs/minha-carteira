<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    {{-- BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    {{-- ION ICON --}}
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/colors.css">

</head>

<body>
    <div class="nav-topo">
        <p id="fechar">topo</p>
    </div>
    <div class="nav-lateral">
        <p>lateral</p>
        @for ($x = 0; $x < 100; $x++)
            {{ $x }} <br>
        @endfor
    </div>
    <div class="click-menu-mobile"></div>
    <div class="conteudo">
        <p>conteudo</p>
        @for ($x = 0; $x < 100; $x++)
            {{ $x }} <br>
        @endfor


        <div class="container card-main">
            <div class="card card-body">

                <div class="d-none">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand text-success" href="#">Minha Carteira</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item active">
                                    <a class="nav-link" href="#">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Inserir</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Relatórios</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Minha Conta</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>

                <div class="m-none center">
                    <h1 class="text-success">Minha Carteira</h1>

                    <nav class="navbar navbar-expand-lg">

                        <div id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item active">
                                    <a class="nav-link" href="#">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Inserir</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Relatórios</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Minha Conta</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>

                @yield('content')
            </div>
        </div>
    </div>

    <script src="js/efects.js"></script>
</body>

</html>
