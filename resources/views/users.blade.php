@extends('layouts/main')

@section('title', 'Usuários')

@section('content')

    @php
    $user_type = [
        1 => 'Admin',
        2 => 'Padrão',
    ];
    @endphp

    @if ($users->count() > 0)
        @foreach ($users as $user)
            <div class="card card-body">
                <small
                    class="txt-small {{ $user->user_type == '1' ? 'txt-blue-4' : 'txt-blue-2' }}">{{ $user_type[$user->user_type] }}</small>
                <div class="row">
                    <div class="col-md col-3">
                        <small class="txt-small txt-grey-1">Nome: <br></small>
                        <span class="txt-desc txt-grey-4">{{ $user->name }}</span>
                    </div>

                    <div class="col-md col-5">
                        <small class="txt-small txt-grey-1">Email: <br></small>
                        <span class="txt-desc txt-grey-4">{{ $user->email }}</span>
                    </div>

                    <div class="col-md-2">
                        <small class="txt-small txt-grey-1">Telefone: <br></small>
                        <span class="txt-desc txt-grey-4">{{ $user->phone }}</span>
                    </div>

                    <div class="col-md-2">
                        <small class="txt-small txt-grey-1">Ação: <br></small>
                        <table>
                            <tr>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                        data-target="#modal-edit{{ $user->id }}" title="Editar registro">
                                        <i class="fas fa-edit"></i></button> &nbsp;
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#modal-delete{{ $user->id }}" title="Remover Registro">
                                        <i class="fas fa-trash"></i></button>

                                </td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
            <br>

            @include('users-modal')
        @endforeach

        {{ $users->links() }}
    @else
        <div class="card card-body">
            Nenhum registro encontrado
        </div>
    @endif
@endsection
