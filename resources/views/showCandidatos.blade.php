@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <h1>Vaga: </h1>
        <h1>{{$vaga->title}}</h1>
        <span>ID: {{$vaga->id}}</span>
        <p>Salario: {{$vaga->salario}}</p>
        <p>Atuação: {{$vaga->area_atuacao}}</p>
        <p>Descrição: {{$vaga->descricao}}</p>
    </div>
    <div class="col-12">
        <h1>Candidatos:</h1>
    </div>
@if($candidatos)

        @foreach(collect($candidatos)->sortByDesc('status')->all() as $candidato)
        <div class="col-12 my-3">
            <h1>Nome: {{$candidato['name']}}</h1>
            @switch($candidato["pivot"]["status"])
            @case(0)
            <p class="w-50 text-center alert alert-danger">Status: Reprovado</p>
            @break
            @case(1)
            <p class="w-50 text-center alert alert-primary">Status: Em analise</p>
            @break
            @case(2)
            <p class="w-50 text-center alert alert-success">Status: Selecionado</p>
            @break
            @default    
    @endswitch
            <p>Email: {{$candidato['email']}}</p>
            <p>Area de Atuação: {{$candidato['curriculo'][0]->area_atuacao}}</p>
            <p>Grau de ensino: {{$candidato['curriculo'][0]->grau_ensino}}</p>
            <p>Experiência: {{$candidato['curriculo'][0]->experiencia}}</p>
            <div class="d-flex">
            <form action="/vaga/mudarstatus/{{$vaga->id}}" method="post">
            @csrf
            <input name="user_id" type="text" value="{{$candidato['id']}}" hidden>
            <input name="status" type="text" value="2" hidden>
            <input class="btn btn-success" type="submit" value="Selecionado">
            </form>
            <form class="mx-3" action="/vaga/mudarstatus/{{$vaga->id}}" method="post">
                @csrf
                <input name="user_id" type="text" value="{{$candidato['id']}}" hidden>
                <input name="status" type="text" value="0" hidden>
                <input class="btn btn-danger" type="submit" value="Não Selecionado">
            </form>
        </div>
        </div>
        @endforeach
    </div>


@else

<h1>Não há candidatos</h1>

@endif


</div>
@endsection