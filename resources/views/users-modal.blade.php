<!-- Modal -->
<div class="modal fade" id="modal-edit{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title txt-blue-4" id="exampleModalLabel">Editar Usuários</h4>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="users/edit/{{ $user->id }}" method="post">
                @csrf
                <div class="modal-body" style="text-align: left; background: #f1f3f7;">
                    <div class="card card-body">
                        <input type="hidden" name="id" value="{{ $user->id }}">

                        <div class="form-group">
                            <b><small>Nome:</small></b>

                            <div class="input-group">
                                <span class="input-group-text"><i
                                        class="fa fa-circle-user txt-blue-3 form-icon"></i></span>
                                <input type="text" name="name" id="name" class="form-control"
                                    value=" {{ $user->name }} ">
                            </div>
                        </div>

                        <div class="form-group">
                            <b><small>Email:</small></b>

                            <div class="input-group">
                                <span class="input-group-text"><i class="far fa-envelope txt-blue-3 form-icon"></i></span>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ $user->email }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <b><small>Telefone:</small></b>

                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-phone txt-blue-3 form-icon"></i></span>
                                <input type="tel" name="phone" id="phone" class="form-control"
                                    value="{{ $user->phone }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <b><small>Tipo de usuário:</small></b>

                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-users-cog txt-blue-3 form-icon"></i></span>
                                <select name="user_type" id="user_type" class="form-control">
                                    <option value="1" {{ $user->user_type == 1 ? 'selected' : '' }}>Admin</option>
                                    <option value="2" {{ $user->user_type == 2 ? 'selected' : '' }}>Padrão</option>
                                </select>
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

<!-- Modal -->
<div class="modal fade" id="modal-delete{{ $user->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tem certeza que deseja excluir?</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="/users/delete/{{ $user->id }}" method="post">
                @csrf
                @method('DELETE')

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
                    <button type="submit" class="btn btn-success">Sim</button>
                </div>
            </form>
        </div>
    </div>
</div>
