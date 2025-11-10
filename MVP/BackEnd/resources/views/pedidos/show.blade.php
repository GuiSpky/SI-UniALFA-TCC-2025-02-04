@extends('layouts.app')

@section('title', 'Detalhe do Pedido')

@section('content')
    <div class="container-fluid py-4">
        <div class="mb-4 fade-in-up">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('pedidos.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill me-3">
                    <i class="bi bi-arrow-left me-2"></i>Voltar
                </a>
                <div>
                    <h1 class="h2 fw-bold mb-1"><i class="bi bi-person-fill me-2"></i>Detalhes do Pedido</h1>
                    <p class="text-muted mb-0">Informações detalhadas do pedido</p>
                </div>
            </div>
        </div>
        <div class="card border-2 shadow-sm rounded-3">
            <div class="card-header border-0 py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-secondary">
                    Pedido: {{ $pedido->id }}
                </h5>
                <span class="badge bg-primary-subtle text-primary px-3 py-2 border border-primary-subtle">
                    ID: {{ $pedido->id }}
                </span>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <p class="mb-1 text-muted small">Data de criação</p>
                        <p class="fw-semibold">{{ $pedido->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="mb-1 text-muted small">Produtos</p>
                        <p class="fw-semibold">
                            @foreach ($pedido->itens as $item)
                                <li>{{ $item->produto->nome }} - {{ $item->quantidade }}</li>
                            @endforeach
                        </p>
                    </div>
                    
                    <hr>
        
                    <x-timestamps :created-at="$pedido->created_at" :updated-at="$pedido->updated_at" />
                </div>
            </div>
        </div>
    @endsection
