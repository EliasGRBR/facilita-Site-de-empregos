@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
     <h1>Area do candidado</h1>
     <h2>Editar Dados Pessoais</h2>
        <form action="/edit/update/{{$user->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input class="form-control" type="text" name="name" id="name" placeholder="Nome" value="{{$user->name}}" required>
                </div>
                <button class="btn btn-primary my-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
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
                <input class="mt-2 btn btn-primary" type="submit" value="Editar">
            </form>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <h2>Curriculo:</h2>
        @if($curriculo)
        <form action="/edit/update/curriculo/{{$user->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <div class="form-group">
                    <label for="area_atuacao">Area de Atuação:</label>
                    <input class="form-control" type="text" name="area_atuacao" id="area_atuacao" placeholder="Area de Atuação" value="{{$curriculo->area_atuacao}}" required>
                </div>
                <div class="form-group">
                    <label for="grau_ensino">Grau de ensino:</label>
                    <input class="form-control" type="text" name="grau_ensino" id="grau_ensino" placeholder="Grau de ensino" value="{{$curriculo->grau_ensino}}">
                </div>
                <div class="form-group">
                    <label for="experiencia">Experiencia:</label>
                    <input class="form-control" type="text" name="experiencia" id="experiencia" placeholder="" value="{{$curriculo->experiencia}}">
                </div>
                <input class="mt-2 btn btn-primary" type="submit" value="Editar Curriculo">
            </form>
    </div>
        @else     
        <form action="/curriculo/create" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                    <label for="area_atuacao">Area de Atuação:</label>
                    <input class="form-control" type="text" name="area_atuacao" id="area_atuacao" placeholder="Area de Atuação" value="" required>
                </div>
                <div class="form-group">
                    <label for="grau_ensino">Grau de ensino:</label>
                    <input class="form-control" type="text" name="grau_ensino" id="grau_ensino" placeholder="Grau de ensino" value="">
                </div>
                <div class="form-group">
                    <label for="experiencia">Experiencia:</label>
                    <input class="form-control" type="text" name="experiencia" id="experiencia" placeholder="Experiencia" value="">
                </div>
                <input class="mt-2 btn btn-primary" type="submit" value="Cadastrar Curriculo">
            </form>
        @endif
    </div>
    <div class="row mt-5">
        <div class="col-12">
            <h1>Vagas Candidatadas:</h1>
        </div>
        @if($vagas)
        @foreach ($vagas as $vaga)
            <div class="col-md-3">
                @switch($vaga->pivot->status)
                    @case(0)
                    <p class="text-center alert alert-danger">Status: Reprovado</p>
                    @break
                    @case(1)
                    <p class="text-center alert alert-primary">Status: Em analise</p>
                    @break
                    @case(2)
                    <p class="text-center alert alert-success">Status: Selecionado</p>
                    @break
                    @default
                        
                @endswitch
                <a class="link" href="/showvaga/{{$vaga->id}}">
                    <p>ID: {{$vaga->id}}</p>
                    <h1>{{$vaga->title}}</h1>
                </a>
                @if($vaga->pivot->status)
                <form action="/deixarvaga/{{$vaga->id}}" method="post">
                    @csrf
                    <input type="submit" value="Excluir Vaga" class="btn btn-danger">
                </form>
                @endif
            </div>
        @endforeach
        @endif
    </div>
</div>
@endsection