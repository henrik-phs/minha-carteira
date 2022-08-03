@extends('layouts/main')

@section('title', 'Minha Carteira')

@section('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"
        integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <div class="row center">
        <div class="col-md-3">
            <div class="card card-body">
                <span class="txt-grey-4">Total de entradas</span><br>
                <span class="text-success">R$ {{ numberFormatBRL($total_pay_in) }}</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-body">
                <span class="txt-grey-4">Total de saídas</span><br>
                <span class="text-danger">R$ {{ numberFormatBRL($total_pay_out) }}</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-body">
                <span class="txt-grey-4">Dia maior entrada</span><br>
                <span class="text-success">{{ dateFormat(@$total_day_in->date) }}</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-body">
                <span class="txt-grey-4">Dia maior saída</span><br>
                <span class="text-danger">{{ dateFormat(@$total_day_out->date) }}</span>
            </div>
        </div>
    </div>

    <br>
    <div class="row">
        <div class="col-md-12">
            <h2>Histórico</h2><br>
            <canvas id="historic" width="400" height="100"></canvas>
        </div>

        @php
            // ENTRADAS
            foreach ($total_history_in as $history_in) {
                $dia[dateFormat($history_in->date)][1] = $history_in->value;
            }
            
            foreach ($total_history_out as $history_out) {
                $dia[dateFormat($history_out->date)][0] = $history_out->value;
            }
            
            // ORDENA O ARRAY
            ksort($dia);
            
        @endphp
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
                labels: [
                    @foreach ($dia as $key => $value)
                        "{{ $key }}",
                    @endforeach
                ],
                datasets: [{
                        label: 'Entradas',
                        data: [
                            @foreach ($dia as $key => $value)
                                "{{ @$value[1] }}",
                            @endforeach
                        ],
                        backgroundColor: '#198754',
                        borderColor: '#299764',
                        borderWidth: 1
                    },
                    {
                        label: 'Saídas',
                        data: [
                            @foreach ($dia as $key => $value)
                                "{{ @$value[0] }}",
                            @endforeach
                        ],
                        backgroundColor: '#dc3545',
                        borderColor: '#ec4555',
                        borderWidth: 1
                    }
                ]
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
