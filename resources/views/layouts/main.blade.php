@php
$url_atual = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

function urlBase(string $uri = null)
{
    if ($uri) {
        return 'http://localhost:8000' . "/{$uri}";
    }

    return 'http://localhost:8000/';
}
@endphp

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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="shortcut icon" href="imgs/logo.png" type="image/x-icon">
    <!-- Styles -->
    <link rel="stylesheet" href="/css/style.css?{{ time() }}">
    <link rel="stylesheet" href="/css/colors.css?{{ time() }}">

</head>

<body>

    <div class="click-menu-mobile"></div>

    <div class="nav-topo">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <button type="button" id="fechar" class="btn btn-link" style="font-size: 20px">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                </li>
            </ul>

            <ul class="navbar-nav nav-right">
                <li class="nav-item">
                    <a href="#" class="txt-blue-3"><i class="far fa-bell"></i></a>
                </li>

                <li class="nav-item">
                    <a href="#" class="txt-blue-3"><i class="fas fa-question-circle"></i></a>
                </li>

                @auth
                    <li class="nav-item">

                        <form action="/logout" method="POST">
                            @csrf
                            <a class="txt-blue-3" href="/logout"
                                onclick="event.preventDefault();this.closest('form').submit();"><i
                                    class="fa-solid fa-right-from-bracket"></i></a>
                        </form>
                    </li>
                @endauth
            </ul>
        </nav>
    </div>

    <div class="nav-lateral">
        <p class="txt-grey-4">
            <img src="imgs/logo.png" alt="" width="22px">
            <span class="txt-menu">Minha Carteira</span>
        </p>

        <ul class="navbar-nav">
            <li class="nav-item {{ $url_atual == urlBase() ? 'active' : '' }}">
                <a class="nav-link txt-grey-4" href="/dashboard">
                    {{-- <ion-icon name="home-outline"></ion-icon> --}}
                    <i class="fa-solid fa-house-chimney txt-blue-3"></i>
                    <span class="txt-menu">Home</span>
                </a>
            </li>

            <li class="nav-item {{ $url_atual == urlBase('insert') ? 'active' : '' }}">
                <a class="nav-link txt-grey-4" href="/insert">
                    {{-- <ion-icon name="add-circle-outline"></ion-icon> --}}
                    <i class="fa-solid fa-circle-plus txt-blue-3"></i>
                    <span class="txt-menu">Inserir</span>
                </a>
            </li>

            <li class="nav-item {{ $url_atual == urlBase('read') ? 'active' : '' }}">
                <a class="nav-link txt-grey-4" href="/read">
                    {{-- <ion-icon name="add-circle-outline"></ion-icon> --}}
                    <i class="fas fa-file-alt txt-blue-3"></i>
                    <span class="txt-menu">Histórico</span>
                </a>
            </li>

            <li class="nav-item {{ $url_atual == urlBase('report') ? 'active' : '' }}">
                <a class="nav-link txt-grey-4" href="/report">
                    {{-- <ion-icon name="bar-chart-outline"></ion-icon> --}}
                    <i class="fa-solid fa-chart-column txt-blue-3"></i>
                    <span class="txt-menu">Relatórios</span>
                </a>
            </li>
            <li class="nav-item {{ $url_atual == urlBase('/account') ? 'active' : '' }}">
                <a class="nav-link txt-grey-4" href="/account">
                    {{-- <ion-icon name="person-circle-outline"></ion-icon> --}}
                    <i class="fa-solid fa-circle-user txt-blue-3"></i>
                    <span class="txt-menu">Minha Conta</span>
                </a>
            </li>

            @if (auth()->user()->user_type == 1)
                <li class="nav-item {{ $url_atual == urlBase('/users') ? 'active' : '' }}">
                    <a class="nav-link txt-grey-4" href="/users">
                        <i class="fas fa-users-cog txt-blue-3"></i>
                        <span class="txt-menu">Usuários</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>

    <div class="conteudo">

        <div class="card-main">
            <div class="container-fluid">

                <h1 class="txt-blue-4">@yield('title')</h1>

                @if (session('msg'))
                    <div class="alert alert-info">
                        {{ session('msg') }}
                    </div>
                @endif

                @yield('content')

            </div>

        </div>
    </div>

    <script src="js/efects.js"></script>
</body>

</html>
