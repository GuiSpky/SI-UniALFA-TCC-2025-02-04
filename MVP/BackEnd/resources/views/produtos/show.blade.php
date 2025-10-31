@extends('layouts.app')

@section('title', 'Detalhe do Produto')

@section('content')

    <div class="container-fluid py-4">
        <div class="mb-4 fade-in-up">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('produtos.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill me-3">
                    <i class="bi bi-arrow-left me-2"></i>Voltar
                </a>
                <div>
                    <h1 class="h2 fw-bold mb-1"><i class="bi bi-person-fill me-2"></i>Detalhes do Produto</h1>
                    <p class="text-muted mb-0">Informações detalhadas do Produto</p>
                </div>
            </div>
        </div>
        <div class="card border-2 shadow-sm rounded-3">
            <div class="card-header border-0 py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-secondary">
                    <i class="bi bi-person-badge me-2"></i>{{ $produto->nome }}
                </h5>
                <span class="badge bg-light text-secondary px-3 py-2 border">
                    ID: {{ $produto->id }}
                </span>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <p class="mb-1 text-muted small">Nome</p>
                        <p class="fw-semibold">{{ $produto->nome }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="mb-1 text-muted small">Grupo</p>
                        <p class="fw-semibold">
                            <x-grupo-label :value="$produto->grupo" />
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endsection
