@extends('layouts.app')

@section('content')
<div class="row">
    @foreach($vagas as $vaga)
    <div class="col-md-3">
        <h3>{{$vaga->title}}</h3>
        <p>Empresa: {{$vaga->name}}</p>
        <p>Salario: {{$vaga->salario}}</p>
        <p>Atuação: {{$vaga->area_atuacao}}</p>
        <a class="btn btn-primary" href="/showvaga/{{$vaga->id}}">Detalhes</a>
    </div>
@endforeach
</div>
@endsection