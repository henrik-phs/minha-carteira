@extends('layouts/main')

@section('title', 'Relatórios')

@section('filter')
    <div class="col-md-2">
        <button class="btn btn-outline-primary" id="btn-search"><i class="fas fa-filter"></i><small>Filtrar</small></span>
    </div>
@endsection

@section('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"
        integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <div class="search" id="form-search" style="display: none">
        <form action="report" method="GET">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <small class="txt-blue-5">Início:</small>
                    <input type="date" name="start" id="start" class="form-control">
                </div>

                <div class="col-md-3">
                    <small class="txt-blue-5">Final:</small>
                    <input type="date" name="end" id="end" class="form-control">
                </div>

                <div class="col-md-3">
                    <small class="txt-blue-5">Descrição:</small>
                    <input type="text" name="description" id="description" class="form-control">
                </div>

                <div class="col-md-3">
                    <small class="txt-blue-5">Categoria:</small>
                    <select name="category" id="category" class="form-control">
                        <option value="">Selecionar...</option>
                        @if ($categories)
                            @foreach ($categories as $category)
                                <option value="{{ $category->category }}">{{ $category->category }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <br>
            <div class="row">
                <div class="col-md-3">
                    <small class="txt-blue-5">Meio Pagamento:</small>
                    <select name="payment_type" id="payment_type" class="form-control">
                        <option value="">Selecionar...</option>
                        <option value="dinheiro">Dinheiro</option>
                        <option value="cartão de crédito">Cartão de crédito</option>
                        <option value="pix">Pix</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <small class="txt-blue-5">Tipo:</small>
                    <select name="type" id="type" class="form-control">
                        <option value="">Selecionar...</option>
                        <option value="1">Entrada</option>
                        <option value="0">Saída</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <small class="text-white">:</small><br>
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </div>
        </form>
    </div>

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
                $dia["$history_in->date"][1] = $history_in->value;
            }
            
            foreach ($total_history_out as $history_out) {
                $dia["$history_out->date"][0] = $history_out->value;
            }
            
            // ORDENA O ARRAY
            if (@$dia) {
                @ksort($dia);
            }
            
        @endphp
    </div>

    <br>
    <div class="row">
        <div class="col-md-8">
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
        /** 
         * CONFIGURAÇÕES DOS FILTROS
        */
        $("#btn-search").click((e) => {
            $("#form-search").toggle();
        });

        /** 
         * CONFIGURAÇÕES DOS GRÁFICOS
        */
        const ctx = document.getElementById('historic').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    @if (@$dia)
                        @foreach (@$dia as $key => $value)
                            "{{ dateFormat($key) }}",
                        @endforeach
                    @endif
                ],
                datasets: [{
                        label: 'Entradas',
                        data: [
                            @if (@$dia)
                                @foreach (@$dia as $key => $value)
                                    "{{ @$value[1] }}",
                                @endforeach
                            @endif
                        ],
                        backgroundColor: '#198754',
                        borderColor: '#299764',
                        borderWidth: 1
                    },
                    {
                        label: 'Saídas',
                        data: [
                            @if (@$dia)
                                @foreach (@$dia as $key => $value)
                                    "{{ @$value[0] }}",
                                @endforeach
                            @endif
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
                data: [{{ $pay_in_cash }}, {{ $pay_in_card }}, {{ $pay_in_pix }}],
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
                data: [{{ $pay_out_cash }}, {{ $pay_out_card }}, {{ $pay_out_pix }}],
                backgroundColor: [
                    '#0A0',
                    '#F60',
                    '#059BFF'
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
