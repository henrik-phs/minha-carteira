@extends('layouts/main')

@section('title', 'Minha Carteira')

@section('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"
        integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <div class="row center">
        {{var_dump($total_in)}}
        <div class="col-md-3">
            <div class="card card-body">
                <span class="txt-grey-4">Total de entradas</span><br>
                <span class="text-success">R$ 200,00</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-body">
                <span class="txt-grey-4">Total de saídas</span><br>
                <span class="text-danger">R$ 250,00</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-body">
                <span class="txt-grey-4">Dia maior entrada</span><br>
                <span class="text-success">17/07/2022</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-body">
                <span class="txt-grey-4">Dia maior saída</span><br>
                <span class="text-danger">15/07/2022</span>
            </div>
        </div>
    </div>

    <br>
    <div class="row">
        <div class="col-md-12">
            <h2>Histórico</h2><br>
            <canvas id="historic" width="400" height="100"></canvas>
        </div>
    </div>

    <br>
    <div class="row">
        <div class="col-md-6">
            <h2>Tipos De Pagamentos</h2>

            <div class="row">
                <div class="col-md-6">
                    <h4>Entradas</h4><br>
                    <canvas id="pay_in"></canvas>
                </div>
                <div class="col-md-6">
                    <h4>Saídas</h4><br>
                    <canvas id="pay_out"></canvas>
                </div>
            </div>

        </div>
    </div>

    <script>
        const ctx = document.getElementById('historic').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // GRÁFICO CIRCULAR ENTRADAS
        const chartPayIn = document.getElementById('pay_in').getContext('2d');
        const dataPayIn = {
            labels: [
                'Dinheiro',
                'Cartão de Crédito',
                'Pix'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [300, 50, 100],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 4
            }]
        };

        const configPayIn = {
            type: 'doughnut',
            data: dataPayIn,
        };

        const myChartPayIn = new Chart(chartPayIn, configPayIn);

        // GRÁFICO CIRCULAR SAÍDAS
        const chartPayOut = document.getElementById('pay_out').getContext('2d');
        const dataPayOut = {
            labels: [
                'Dinheiro',
                'Cartão de Crédito',
                'Pix'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [300, 50, 100],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 4
            }]
        };

        const configPayOut = {
            type: 'doughnut',
            data: dataPayOut,
        };

        const myChartPayOut = new Chart(chartPayOut, configPayOut);
    </script>

@endsection
