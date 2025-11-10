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
                    <h1 class="h2 fw-bold mb-1"><i class="bi bi-person-fill me-2"></i>Detalhes do Usuário</h1>
                    <p class="text-muted mb-0">Informações detalhadas do usuário</p>
                </div>
            </div>
        </div>
        <div class="card border-2 shadow-sm rounded-3">
            <div class="card-header border-0 py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-secondary">
                    <i class="bi bi-person-badge me-2"></i>{{ $user->name }}
                </h5>
                <span class="badge bg-primary-subtle text-primary px-3 py-2 border border-primary-subtle">
                    ID: {{ $user->id }}
                </span>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <p class="mb-1 text-muted small">Nome</p>
                        <p class="fw-semibold">{{ $user->name }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="mb-1 text-muted small">Email</p>
                        <p class="fw-semibold">{{ $user->email }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="mb-1 text-muted small">Telefone</p>
                        <p class="fw-semibold">{{ $user->telefone }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="mb-1 text-muted small">Cargo</p>
                        <p class="fw-semibold">
                            <x-cargo-label :value="$user->cargo" />
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="mb-1 text-muted small">Local de Trabalho</p>
                        <p class="fw-semibold">
                            {{ $escolas->where('id', $user->id_escola)->pluck('nome')->first() }}
                        </p>
                    </div>
                                        
                    <hr>
        
                    <x-timestamps :created-at="$user->created_at" :updated-at="$user->updated_at" />
                </div>
            </div>
        </div>
    @endsection
