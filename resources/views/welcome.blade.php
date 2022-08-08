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

    <title>Minha Carteira</title>

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
    <div class="menu-home">
        <nav class="txt-grey-4 menu-logo">
            <img src="imgs/logo.png" alt="" width="30px">
            <span class="txt-menu">Minha Carteira</span>
        </nav>

        <nav class="nav-menu-inline-1">
            <ul>
                <li><a href="/login" class="txt-grey-4">Entrar</a></li>
                <li><a href="/register" class="btn-home">Cadastrar</a></li>
            </ul>
        </nav>
    </div>

    <div class="header-home">
        <div style="text-align: center;">
            <h1>Gerecie as entradas e saída <br> de caixa do seu negócio</h1>

            <br>
            <a href="/login" class="btn-home">Minha Carteira</a>
        </div>

        <br><br>
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-4">
                    <canvas id="pay_in"></canvas>
                </div>
                <div class="col-md-4 col-8" style="display: flex; align-items: center;">
                    <div>
                        <h4>Relatórios em Gráficos</h4>
                        <p>Facilidade ao acompanhar seu fluxo de caixa com gráficos</p>
                    </div>
                </div>

                <div class="col-md-2 col-4" style="display: flex; align-items: center;">
                    <img src="imgs/historico2.png" alt="" width="100%">
                </div>
                <div class="col-md-4 col-8" style="display: flex; align-items: center;">
                    <div>
                        <h4>Histórico Completo</h4>
                        <p>Tenha acesso ao histórico completo, edite ou exclua registros, tudo na palma da mão</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"
        integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const chartPayIn = document.getElementById('pay_in').getContext('2d');
        const dataPayIn = {
            datasets: [{
                label: 'My First Dataset',
                data: [60, 30, 40],
                backgroundColor: [
                    '#0F0',
                    '#F60',
                    '#059BFF'
                ],
                hoverOffset: 4
            }]
        };

        const configPayIn = {
            type: 'doughnut',
            data: dataPayIn,
        };

        const myChartPayIn = new Chart(chartPayIn, configPayIn);
    </script>
</body>

</html>
