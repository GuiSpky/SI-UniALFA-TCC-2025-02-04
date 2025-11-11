@extends('layouts.app')

@section('title', 'Detalhes do Item')

@section('content')

    <div class="container-fluid py-4">
        <div class="mb-4 fade-in-up">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('itemProdutos.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill me-3">
                    <i class="bi bi-arrow-left me-2"></i>Voltar
                </a>
                <div>
                    <h1 class="h2 fw-bold mb-1"><i class="bi bi-person-fill me-2"></i>Detalhes do Item</h1>
                    <p class="text-muted mb-0">Informações detalhadas do item</p>
                </div>
            </div>
        </div>
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-secondary">
                    <i class="bi bi-person-badge me-2"></i>Id Estoque: {{ $itemProduto->id }}
                </h5>
                <span class="badge bg-primary-subtle text-primary px-3 py-2 border border-primary-subtle">
                    ID: {{ $itemProduto->id }}
                </span>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <p class="mb-1 text-muted small">Produto</p>
                        <p class="fw-semibold">
                            {{ $produtos->where('id', $itemProduto->id_produto)->pluck('nome')->first() }}
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="mb-1 text-muted small">Quantidade de entrada ({{ $produtos->where('id', $itemProduto->id_produto)->pluck('medida')->first() ?? 'N/A' }})</p>
                        <p class="fw-semibold">{{ $itemProduto->quantidade_entrada }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="mb-1 text-muted small">Quantidade de saldo ({{ $produtos->where('id', $itemProduto->id_produto)->pluck('medida')->first() ?? 'N/A' }})</p>
                        <p class="fw-semibold">{{ $itemProduto->quantidade_entrada - $itemProduto->quantidade_saida }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="mb-1 text-muted small">Validade</p>
                        <p class="fw-semibold">{{ \Carbon\Carbon::parse($itemProduto->validade)->format('d/m/Y') }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="mb-1 text-muted small">Data da entrada</p>
                        <p class="fw-semibold">{{ $itemProduto->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="mb-1 text-muted small">Armazém</p>
                        <p class="fw-semibold">
                            {{ $escolas->where('id', $itemProduto->id_escola)->pluck('nome')->first() }}
                        </p>
                    </div>
                </div>

                    <hr>

                    <x-timestamps :created-at="$itemProduto->created_at" :updated-at="$itemProduto->updated_at" />
            </div>
        </div>
    </div>
@endsection
