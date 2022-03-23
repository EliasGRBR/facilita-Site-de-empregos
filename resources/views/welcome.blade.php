@extends('layouts.app')
@section('title', '- As melhores vagas')
@section('content')
<div class="row">
    <h1>As melhores vagas:</h1>
    @foreach($vagas as $vaga)
    <div class="col-md-4 mt-4">
    <div class="card shadow-sm">
        <div class="card-header azul-fraco">
            <h3>{{$vaga->title}}</h3>
        </div>
        <div class="card-body">
          <h5 class="card-title">Empresa: {{$vaga->name}}</h5>
          <p class="card-text">Local: {{$vaga->detalhes_empresa['local']}}</p>
          <p class="card-text">Salario: R${{$vaga->salario}}</p>
          <p class="card-text">Atuação: {{$vaga->area_atuacao}}</p>
          <a class="btn azul-fraco fw-bold d-flex w-25 justify-content-center mx-auto" href="/showvaga/{{$vaga->id}}">Detalhes</a>
        </div>
      </div>
        
    </div>
@endforeach
</div>
@endsection