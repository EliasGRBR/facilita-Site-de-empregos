@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-6">
        <h1>{{$vaga->title}}</h1>
        <span>ID: {{$vaga->id}}</span>
        <p>Empresa: {{$donoVaga->name}}</p>
        <p>Salario: {{$vaga->salario}}</p>
        <p>Atuação: {{$vaga->area_atuacao}}</p>
        <p>Descrição: {{$vaga->descricao}}</p>
        
        @if(Auth::user())
            @if(Auth::user()->empresa)
            @else
                @if(!$hasUserJoined)
                    <form action="/candidatar/{{$vaga->id}}" method="post">
                    @csrf
                    <input type="submit" value="Candidatar-se" class="btn btn-primary">
                    </form>
                @else
                    <p class="alert alert-danger text-center">Já Canditadato</p>
            @endif
        @endif
            @else
            <form action="/candidatar/{{$vaga->id}}" method="post">
                @csrf
                <input type="submit" value="Candidatar-se" class="btn btn-primary">
            </form>
        @endif

    </div>
</div>

@endsection