@extends('layouts/main')

@section('title', 'Histórico de entradas e saídas')

@section('content')

    @php
    $tipo = [
        0 => 'fas fa-arrow-circle-down text-danger',
        1 => 'fas fa-arrow-circle-up text-success',
    ];

    $tipoSinal = [
        0 => ['-', 'text-danger'],
        1 => ['+', 'text-success'],
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

    @if ($users->count() > 0)
        @foreach ($users as $user)
            <div class="card card-body">
                <div class="row">
                    <div class="col-md-2 col-6">
                        <small class="txt-small txt-grey-1">Data: <br></small>
                        <span class="txt-desc txt-grey-4">{{ date('d/m/Y', strtotime($user->date)) }}</span>
                    </div>

                    <div class="col-md-2 col-6">
                        <small class="txt-small txt-grey-1">Valor: <br></small>
                        <b>
                            <span class="txt-desc">
                                R$
                                {{ number_format($user->value, 2, ',', '.') }}
                            </span>
                        </b>
                    </div>

                    <div class="col-md-3">
                        <small class="txt-small txt-grey-1">Descrição: <br></small>
                        <span class="txt-desc txt-grey-4">{{ $user->description }}</span>
                    </div>

                    <div class="col-md-3">
                        <small class="txt-small txt-grey-1">Categoria: <br></small>
                        <span class="txt-desc txt-grey-4">{{ $user->category }}</span>
                    </div>

                    <div class="col-md-2">
                        <small class="txt-small txt-grey-1">Tipo: <br></small>
                        <table>
                            <tr>
                                <td>
                                    <span style="font-size: 24px"><i class=""
                                            title="{{ $user->type_payment }}"></i></span> &nbsp;
                                </td>
                                <td>
                                    <a href="/edit/{{ $user->id }}" class="btn btn-warning btn-sm"
                                        title="Editar registro"><i class="fas fa-edit"></i></a> &nbsp;
                                </td>
                                <td>
                                    <form action="/delete/data/{{ $user->id }}" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm" title="Remover Registro"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
            <br>
        @endforeach
    @else
        <div class="card card-body">
            Nenhum registro encontrado
        </div>
    @endif
@endsection
