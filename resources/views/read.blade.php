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

    @if ($inserts->count() > 0)

        <div class="search">
            <form action="read" method="GET">
                @csrf
                <div class="row">
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
            </form>
        </div>
        </div>

        @foreach ($inserts as $insert)
            <div class="card card-body">
                <div class="row">
                    <div class="col-md-2 col-6">
                        <small class="txt-small txt-grey-1">Data: <br></small>
                        <span class="txt-desc txt-grey-4">{{ date('d/m/Y', strtotime($insert->date)) }}</span>
                    </div>

                    <div class="col-md-2 col-6">
                        <small class="txt-small txt-grey-1">Valor: <br></small>
                        <b>
                            <span class="txt-desc {{ $tipoSinal[$insert->type][1] }}">
                                {{ $tipoSinal[$insert->type][0] }}R$
                                {{ number_format($insert->value, 2, ',', '.') }}
                            </span>
                        </b>
                    </div>

                    <div class="col-md-3">
                        <small class="txt-small txt-grey-1">Descrição: <br></small>
                        <span class="txt-desc txt-grey-4">{{ $insert->description }}</span>
                    </div>

                    <div class="col-md-3">
                        <small class="txt-small txt-grey-1">Categoria: <br></small>
                        <span class="txt-desc txt-grey-4">{{ $insert->category }}</span>
                    </div>

                    <div class="col-md-2">
                        <small class="txt-small txt-grey-1">Meio Pagamento: <br></small>
                        <table>
                            <tr>
                                <td>
                                    <span style="font-size: 24px"><i class="{{ $tipoPagamento[$insert->type_payment] }}"
                                            title="{{ $insert->type_payment }}"></i></span> &nbsp;
                                </td>
                                <td>
                                    <a href="/edit/{{ $insert->id }}" class="btn btn-warning btn-sm"
                                        title="Editar registro"><i class="fas fa-edit"></i></a> &nbsp;
                                </td>
                                <td>
                                    <form action="/delete/data/{{ $insert->id }}" method="post">
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

        {{ @$inserts->links() }}
    @else
        <div class="card card-body">
            Nenhum registro encontrado
        </div>
    @endif
@endsection
