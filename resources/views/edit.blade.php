@extends('layouts/main')

@section('title', 'Editar entrada ou saída de dinheiro')

@section('content')

    <form action="/edit/data/{{$insert->id}}" method="post">
        @csrf

        <div class="row">
            <div class="form-group col-md-4">
                <b class="txt-grey-3">Valor (R$): </b>
                <input type="text" name="value" id="value" class="form-control" value="{{ $insert->value }}">
            </div>

            <div class="form-group col-md-4">
                <b class="txt-grey-3">Descrição: </b>
                <input type="text" name="description" id="description" class="form-control" value="{{ $insert->description }}">
            </div>

            <div class="form-group col-md-4">
                <b class="txt-grey-3">Tipo: </b>
                <select name="type" id="type" class="form-control">
                    <option value="1" {{ $insert->type == 1 ? "selected" : "" }}>Entrada</option>
                    <option value="0" {{ $insert->type == 0 ? "selected" : "" }}>Saída</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <b class="txt-grey-3">Categoria</b>
                <input type="text" name="category" id="category" class="form-control" value="{{ $insert->category }}">
            </div>

            <div class="form-group col-md-4">
                <b class="txt-grey-3">Meio pagamento: </b>
                <select name="type_payment" id="type_payment" class="form-control">
                    <option value="dinheiro" {{ $insert->type_payment == "dinheiro" ? "selected" : "" }}>Dinheiro</option>
                    <option value="cartão de crédito" {{ $insert->type_payment == "cartão de crédito" ? "selected" : "" }}>Cartão de crédito</option>
                    <option value="pix" {{ $insert->type_payment == "pix" ? "selected" : "" }}>Pix</option>
                </select>
            </div>

            <div class="form-group col-md-4">
                <b class="txt-grey-3">Data: </b>
                <input type="date" name="date" id="date" class="form-control" value="{{ $insert->date->format('Y-m-d') }}">
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Inserir</button>
        </div>
    </form>
@endsection
