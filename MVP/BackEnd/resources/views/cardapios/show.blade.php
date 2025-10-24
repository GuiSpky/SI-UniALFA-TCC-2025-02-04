@extends('layouts.app')
@section('tittle', 'Detalhe do Cardápio')
@section('content')
<div class="container-fluid py-4">
    <div class="mb-4 fade-in-up">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('cardapios.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill me-3">
                <i class="bi bi-arrow-left me-2"></i>Voltar
            </a>
            <div>
                <h1 class="h3 fw-bold mb-1 text-primary">
                    <i class="bi bi-person-fill me-2"></i>Detalhes do Cardápio
                </h1>
                <p class="text-muted mb-0">Visualize as informações completas deste cardápio</p>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-secondary">
                <i class="bi bi-person-badge me-2"></i>{{ $cardapio->nome }}
            </h5>
            <span class="badge bg-light text-secondary px-3 py-2 border">
                ID: {{ $cardapio->id }}
            </span>
        </div>

        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <p class="mb-1 text-muted small">Nome</p>
                    <p class="fw-semibold">{{ $cardapio->nome }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="mb-1 text-muted small">Item</p>
                    <p class="fw-semibold">{{ $cardapio->item }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="mb-1 text-muted small">Data</p>
                    <p class="fw-semibold">{{ $cardapio->data }}</p>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('cardapios.index') }}" class="btn btn-outline-primary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-2"></i>Voltar à lista
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
