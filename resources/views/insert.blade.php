@extends('layouts/main')

@section('title', 'Inserir entrada ou saída de dinheiro')

@section('content')

    <form action="/insert/data" method="post">
        @csrf

        <div class="row">
            <div class="form-group col-md-4">
                <b class="txt-grey-3">Valor (R$): </b>
                <input type="text" name="value" id="value" class="form-control">
            </div>

            <div class="form-group col-md-4">
                <b class="txt-grey-3">Descrição: </b>
                <input type="text" name="description" id="description" class="form-control">
            </div>

            <div class="form-group col-md-4">
                <b class="txt-grey-3">Tipo: </b>
                <select name="type" id="type" class="form-control">
                    <option value="1">Entrada</option>
                    <option value="0">Saída</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <b class="txt-grey-3">Categoria</b>
                <input type="text" name="category" id="category" class="form-control">
            </div>

            <div class="form-group col-md-4">
                <b class="txt-grey-3">Meio pagamento: </b>
                <select name="type_payment" id="type_payment" class="form-control">
                    <option value="dinheiro">Dinheiro</option>
                    <option value="cartão de crédito">Cartão de crédito</option>
                    <option value="pix">Pix</option>
                </select>
            </div>

            <div class="form-group col-md-4">
                <b class="txt-grey-3">Data: </b>
                <input type="date" name="date" id="date" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Inserir</button>
        </div>
    </form>
@endsection
