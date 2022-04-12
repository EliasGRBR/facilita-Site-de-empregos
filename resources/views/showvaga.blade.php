@extends('layouts.app')
@section('title', '- ' . $vaga->title)

@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="card">
        <div class="card-header azul-fraco">
        <h1>{{$vaga->title}}</h1>
        </div>
        <div class="card-body">
        <span class="mb-2 d-flex">ID: {{$vaga->id}}</span>
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
                            <input type="submit" value="Candidatar-se" class="btn btn azul-fraco fw-bold">
                            </form>
                        @else
                            <p class="alert alert-danger text-center">Já Canditadato</p>
                    @endif
                @endif
                    @else
                    <form action="/candidatar/{{$vaga->id}}" method="post">
                        @csrf
                        <input type="submit" value="Candidatar-se" class="btn btn azul-fraco fw-bold">
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection