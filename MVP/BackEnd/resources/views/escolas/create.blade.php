@extends('layouts.app')
@section('title', 'Nova Escola')
@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="mb-4 fade-in-up">
        <div class="d-flex align-items-center mb-3">
            <a href="{{route('escolas.index')}}" class="btn btn-outline-secondary btn-sm me-3">
                <i class="bi bi-arrow-left me-2"></i>Voltar
            </a>
            <div>
                <h1 class="h2 fw-bold mb-1"><i class="bi bi-house-plus-fill me-2"></i>Nova Escola</h1>
                <p class="text-muted mb-0">Preencha os dados para cadastrar uma nova escola</p>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card fade-in-up shadow-sm border-0">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('escolas.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        
                        <!-- Nome -->
                        <div class="mb-3">
                            <label for="nome" class="form-label">
                                <i class="bi bi-building me-2"></i>Nome da Escola
                            </label>
                            <input type="text" name="nome" id="nome" class="form-control" placeholder="Digite o nome da escola" required>
                            <div class="invalid-feedback">Por favor, insira o nome da escola.</div>
                        </div>

                        <!-- Cidade -->
                        <div class="mb-3">
                            <label for="id_cidade" class="form-label">
                                <i class="bi bi-geo-alt me-2"></i>Cidade
                            </label>
                            <select name="id_cidade" id="id_cidade" class="form-select" required>
                                <option value="" disabled selected>-- Escolha uma cidade --</option>
                                @foreach ($cidades as $cidade)
                                    <option value="{{ $cidade->id }}">{{ $cidade->nome }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Por favor, selecione uma cidade.</div>
                        </div>

                        <!-- Bairro -->
                        <div class="mb-3">
                            <label for="id_bairro" class="form-label">
                                <i class="bi bi-map me-2"></i>Bairro
                            </label>
                            <select name="id_bairro" id="id_bairro" class="form-select" required>
                                <option value="" disabled selected>-- Escolha um bairro --</option>
                                @foreach ($bairros as $bairro)
                                    <option value="{{ $bairro->id }}">{{ $bairro->nome }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Por favor, selecione um bairro.</div>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-end gap-3 mt-5 pt-4 border-top">
                            <a class="btn btn-outline-secondary" href="{{route('escolas.index')}}">
                                <i class="bi bi-x-circle me-2"></i>Cancelar
                            </a>
                            <button class="btn btn-primary" type="submit">
                                <i class="bi bi-save me-2"></i>Salvar Escola
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

