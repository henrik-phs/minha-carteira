@extends('layouts/main')
@section('title', 'Minha Conta')
@section('content')

    <div class="row">
        <div class="col-md-4">
            <i class="fa fa-circle-user txt-blue-4 icon-menu"></i>
        </div>

        <div class="col-md-8">
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa fa-circle-user txt-blue-3 form-icon"></i></span>
                <input type="text" name="name" id="name" class="form-control"
                    value="{{ $user->name }}">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text"><i class="far fa-envelope txt-blue-3 form-icon"></i></span>
                <input type="email" class="form-control" name="email" id="email"
                    value="{{ $user->email }}">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa fa-phone txt-blue-3 form-icon"></i></span>
                <input type="tel" class="form-control" name="phone" id="phone" value="(33) 99910-2490">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fas fa-lock txt-blue-3 form-icon"></i></span>
                <input type="password" class="form-control" name="pass" id="pass" value="">
            </div>

            <button type="submit" class="btn btn-primary"><i class="far fa-check-circle form-ico"></i> Salvar</button>
        </div>
    </div>
@endsection
