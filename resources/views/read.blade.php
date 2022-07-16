@extends('layouts/main')

@section('title', 'Histórico de entradas e saídas')

@section('content')

    @php
    $tipo = [
        0 => 'fas fa-arrow-circle-down text-danger',
        1 => 'fas fa-arrow-circle-up text-success',
    ];

    $tipoNome = [
        0 => 'saída',
        1 => 'entrada',
    ];

    $tipoPagamento = [
        'dinheiro' => 'fa-solid fa-money-bill-1 text-success',
        'cartão de crédito' => 'fa-solid fa-credit-card text-success',
        'pix' => 'fa-brands fa-pix text-info',
    ];
    @endphp

    @if ($inserts)
        @foreach ($inserts as $insert)
            <div class="card card-body">
                <div class="row">
                    <div class="col-md-2">
                        <small class="txt-small txt-grey-1">Data:</small><br>
                        <span class="txt-desc txt-grey-4">{{ date('d/m/Y', strtotime($insert->date)) }}</span>
                    </div>

                    <div class="col-md-2">
                        <small class="txt-small txt-grey-1">Valor:</small><br>
                        <span class="txt-desc txt-grey-4">R$ {{ number_format($insert->value, 2, ',', '.') }}</span>
                    </div>

                    <div class="col-md-3">
                        <small class="txt-small txt-grey-1">Descrição:</small><br>
                        <span class="txt-desc txt-grey-4">{{ $insert->description }}</span>
                    </div>

                    <div class="col-md-3">
                        <small class="txt-small txt-grey-1">Categoria:</small><br>
                        <span class="txt-desc txt-grey-4">{{ $insert->category }}</span>
                    </div>

                    <div class="col-md-2">
                        <small class="txt-small txt-grey-1">Tipo:</small><br>
                        <span style="font-size: 20px"><i class="{{ $tipo[$insert->type] }}"
                                title="{{ $tipoNome[$insert->type] }}"></i></span> &nbsp;

                        <span style="font-size: 20px"><i class="{{ $tipoPagamento[$insert->type_payment] }}"
                                title="{{ $insert->type_payment }}"></i></span> &nbsp;

                        <a href="/edit/{{ $insert->id }}" class="btn btn-warning btn-sm" title="Editar registro"><i class="fas fa-edit"></i></a>

                        <form action="/delete/data/{{ $insert->id }}" method="post">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger btn-sm" title="Remover Registro"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <br>
        @endforeach
    @endif
@endsection
