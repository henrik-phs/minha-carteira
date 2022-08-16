@extends('layouts/main')
@section('title', 'Minha Conta')
@section('content')

    <div class="row">
        <div class="col-md-4 center">
            @if (!$user->profile_photo_path)
                <i class="fa fa-circle-user txt-blue-4 icon-menu"></i><br>
                <button type="button" class="btn btn-link" data-toggle="modal"
                                        data-target="#modal-edit{{ $user->id }}" title="Editar registro">
                                        Adicionar foto de perfil</button>
            @else
                <img src="imgs/users/{{ $user->profile_photo_path }}" alt="" width="100%" style="border-radius: 10px">
                <button type="button" class="btn btn-link" data-toggle="modal"
                                        data-target="#modal-edit{{ $user->id }}" title="Editar registro">
                                        Alterar foto de perfil</button>
            @endif
        </div>

        <div class="col-md-8">
            <form action="/account/edit/{{ $user->id }}" method="post">
                @csrf

                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa fa-circle-user txt-blue-3 form-icon"></i></span>
                    <input type="text" name="name" id="name" class="form-control" value="{{ @$user->name }}">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="far fa-envelope txt-blue-3 form-icon"></i></span>
                    <input type="email" class="form-control" name="email" id="email" value="{{ @$user->email }}">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa fa-phone txt-blue-3 form-icon"></i></span>
                    <input type="tel" class="form-control" name="phone" id="phone" value="{{ @$user->phone }}">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fas fa-lock txt-blue-3 form-icon"></i></span>
                    <input type="password" class="form-control" name="pass" id="pass" value="">
                </div>

                <button type="submit" class="btn btn-primary"><i class="far fa-check-circle form-ico"></i> Salvar</button>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modal-edit{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title txt-blue-4" id="exampleModalLabel">Editar Usuários</h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
    
                <form action="account/photo/{{ $user->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body" style="text-align: left; background: #f1f3f7;">
                        <div class="card card-body">
                            <input type="hidden" name="id" value="{{ $user->id }}">
    
                            <div class="form-group">
                                <b><small>{{$user->profile_photo_path ? "Alterar" : "Adicionar"}} foto de perfil:</small></b>
    
                                <div class="input-group">
                                    <span class="input-group-text"><i
                                            class="fa fa-circle-user txt-blue-3 form-icon"></i></span>
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>
                            </div>
                        </div>
    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
