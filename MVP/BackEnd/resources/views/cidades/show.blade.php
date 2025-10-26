@extends('layouts.app')
@section('title', 'Detalhe da Cidade')
@section('content')
<div class="container-fluid">
    <div class="mb-4 fade-in-up">
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route('cidades.index') }}" class="btn btn-outline-secondary btn-sm me-3">
                <i class="bi bi-arrow-left me-2"></i>Voltar
            </a>
            <div>
                <h1 class="h2 fw-bold mb-1"><i class="bi bi-geo-alt me-2"></i>Detalhes da Cidade</h1>
                <p class="text-muted mb-0">Informações detalhadas da cidade</p>
            </div>
        </div>
    </div>
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-bottom-0">
            <h5 class="mb-0">Detalhes da Cidade: {{$cidade->nome}}</h5>
        </div>
        <div class="card-body">
            <p><strong>Cód. IBGE: </strong>{{$cidade->codIbge}}</p>
            <p><strong>Nome: </strong>{{$cidade->nome}}</p>
            <p><strong>UF: </strong>{{$cidade->uf}}</p>
            <br>
            <a class="btn btn-outline-secondary" href="{{ route('cidades.index') }}"><i class="bi bi-arrow-left me-2"></i>Voltar</a>
        </div>
    </div>
</div>
@endsection
