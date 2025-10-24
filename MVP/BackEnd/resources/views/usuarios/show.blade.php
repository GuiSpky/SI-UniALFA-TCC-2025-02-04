@extends('layouts.app')
@section('title', 'Detalhe do Usuário')

@section('content')
<div class="container-fluid py-4">
    <div class="mb-4 fade-in-up">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill me-3">
                <i class="bi bi-arrow-left me-2"></i>Voltar
            </a>
            <div>
                <h1 class="h3 fw-bold mb-1 text-primary">
                    <i class="bi bi-person-fill me-2"></i>Detalhes do Usuário
                </h1>
                <p class="text-muted mb-0">Visualize as informações completas deste usuário</p>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-secondary">
                <i class="bi bi-person-badge me-2"></i>{{ $usuario->nome }}
            </h5>
            <span class="badge bg-light text-secondary px-3 py-2 border">
                ID: {{ $usuario->id }}
            </span>
        </div>

        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <p class="mb-1 text-muted small">Nome</p>
                    <p class="fw-semibold">{{ $usuario->nome }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="mb-1 text-muted small">Email</p>
                    <p class="fw-semibold">{{ $usuario->email }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="mb-1 text-muted small">Telefone</p>
                    <p class="fw-semibold">{{ $usuario->telefone }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="mb-1 text-muted small">Cargo</p>
                    <p class="fw-semibold">{{ $usuario->cargo }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <p class="mb-1 text-muted small">Escola</p>
                    <p class="fw-semibold">
                        {{ $escolas->where('id', $usuario->id_escola)->pluck('nome')->first() }}
                    </p>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('usuarios.index') }}" class="btn btn-outline-primary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-2"></i>Voltar à lista
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
