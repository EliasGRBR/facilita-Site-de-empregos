@extends('layouts.app')
@section('title', '- ' . $user->name)
@section('content')
<div class="row">
    <div class="col-12">
     <h1>Area da Empresa</h1>
     <h2>Editar Dados Pessoais</h2>
        <form action="/edit/update/empresa/{{$user->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <div class="form-group">
                    <label for="name">Nome da Empresa:</label>
                    <input class="form-control" type="text" name="name" id="name" placeholder="Nome" value="{{$user->name}}" required>
                </div>
                <button class="btn azul-fraco fw-bold my-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Editar senha
                  </button><br>
                <div class="form-group collapse" id="collapseExample">
                <div class="form-group">
                    <label for="old-pass">Senha antiga:</label>
                    <input class="form-control" type="password" name="old-pass" id="old-pass" placeholder="Senha antiga" value="">
                </div>
                <div class="form-group">
                    <label for="newPass">Nova senha</label>
                    <input minlength="8" maxlength="20" class="form-control" type="text" name="newPass" id="newPass" placeholder="Nova Senha" value="">
                </div>
                <div class="form-group">
                    <label for="confirmPass">Confirmar nova Senha:</label>
                    <input minlength="8" maxlength="20" class="form-control" type="text" name="confirmPass" id="confirmPass" placeholder="Confirmar senha" value="">
                </div>
            </div>
                <input class="mt-2 btn azul-fraco fw-bold" type="submit" value="Editar">
            </form>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <h2>Detalhes da empresa:</h2>
        @if($detalhes)
        <form action="/edit/update/detalhes/{{$user->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <div class="form-group">
                    <label for="ramo_de_atuacao">Ramo de atuação:</label>
                    <input class="form-control" type="text" name="ramo_de_atuacao" id="ramo_de_atuacao" placeholder="Ramo de atuação" value="{{$detalhes->ramo_de_atuacao}}" required>
                </div>
                <div class="form-group">
                    <label for="local">Local:</label>
                    <input class="form-control" type="text" name="local" id="local" placeholder="Local" value="{{$detalhes->local}}">
                </div>
                <input class="my-3 btn azul-fraco fw-bold" type="submit" value="Editar Detalhes">
            </form>
    </div>
        @else     
        <form action="/detalhes/create" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                    <label for="local">Local:</label>
                    <input class="form-control" type="text" name="local" id="local" placeholder="Local" value="" required>
                </div>
                <div class="form-group">
                    <label for="ramo_de_atuacao">Ramo de atuação:</label>
                    <input class="form-control" type="text" name="ramo_de_atuacao" id="ramo_de_atuacao" placeholder="Ramo de atuação" value="">
                </div>
                <input class="mt-2 btn azul-fraco fw-bold" type="submit" value="Cadastrar Detalhes da empresa">
            </form>
        @endif
    </div>

<div class="row">
    <div class="col-12">
        <h2>Cadastrar Vaga:</h2>
    </div>
    <form action="/new/vaga" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <label for="title">Titulo:</label>
                <input class="form-control" type="text" name="title" id="title" placeholder="Titulo" value="" required>
            </div>
            <div class="form-group">
                <label for="salario">Salario:</label>
                <input class="form-control" type="text" name="salario" id="salario" placeholder="Salario" value="" required>
            </div>
            <div class="form-group">
                <label for="area_atuacao">Area de atuação:</label>
                <input class="form-control" type="text" name="area_atuacao" id="area_atuacao" placeholder="Area de Atuação" value="" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <input class="form-control" type="text" name="descricao" id="descricao" placeholder="Descrição" value="" required>
            </div>
            <input class="mt-2 btn azul-fraco fw-bold" type="submit" value="Cadastrar vaga">
        </form>
</div>
    <div class="row pt-3">

            @if(count($vagas) > 0)
                @foreach ($vagas as $vaga)
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h1>{{$vaga->title}}</h1>
                        </div>
                        <div class="card-body">
                                <p>Salario: R${{$vaga->salario}}</p>
                                <p>Atuação: {{$vaga->area_atuacao}}</p>
                                <p>Descrição: {{$vaga->descricao}}</p>
                                <div class="d-flex">
                                <a class="btn azul-fraco fw-bold"href="vaga/candidatos/{{$vaga->id}}">Ver candidatos</a>
                                <form action="delete/vaga/{{$vaga->id}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn btn-danger mx-3" type="submit" value="Excluir Vaga">
                                </form>
                            </div>
                        </div> 
                    </div>
                </div>
                @endforeach
            @endif

    </div>
</div>
@endsection
