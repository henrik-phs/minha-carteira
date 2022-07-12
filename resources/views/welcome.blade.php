@extends('layouts/main')

@section('title', 'Minha Carteira')

@section('content')

    <div class="row center">
        <div class="col-md-6">
            <a href="/insert">
                <div class="card card-body">
                    <span>
                        <ion-icon name="add-circle-outline" class="icon-menu txt-blue-3"></ion-icon><br>
                        <span class="txt-grey-4">Inserir </span>
                    </span>
                </div>
            </a>
        </div>

        <div class="col-md-6">
            <a href="#">
                <div class="card card-body">
                    <span>
                        <ion-icon name="bar-chart-outline" class="icon-menu txt-blue-3"></ion-icon><br>
                        <span class="txt-grey-4">Relatório</span>
                    </span>
                </div>
            </a>
        </div>

    </div>
@endsection
