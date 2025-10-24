@extends('layouts.app')
@section("title", "Detalhe da Escola")
@section("content")
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="mb-4 fade-in-up">
        <div class="d-flex align-items-center mb-3">
            <a href="{{route("escolas.index")}}" class="btn btn-outline-secondary btn-sm me-3" style="border-color: #2a2a3e; color: #b0b0b0; transition: all 0.3s ease;">
                <i class="bi bi-arrow-left me-2"></i>Voltar
            </a>
            <div>
                <h1 class="h2 fw-bold mb-1" style="color: #ffffff;">
                    <i class="bi bi-house-door-fill me-2"></i>{{ $escola->nome }}
                </h1>
                <p class="text-muted mb-0">Informações detalhadas da escola</p>
            </div>
        </div>
    </div>
@endsection

