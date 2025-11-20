@extends('layouts.app')

@section('title', 'Nova Escola')

@section('content')

    <div class="container-fluid py-4">
        <div class="mb-4 fade-in-up">
            <div class="d-flex align-items-center mb-3">
                <a href="{{ route('escolas.index') }}" class="btn btn-outline-secondary btn-sm me-3">
                    <i class="bi bi-arrow-left me-2"></i>Voltar
                </a>
                <div>
                    <h1 class="h2 fw-bold mb-1"><i class="bi bi-mortarboard-fill me-2"></i>Nova Escola</h1>
                    <p class="text-muted mb-0">Preencha os dados para cadastrar uma nova escola</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card fade-in-up border-2 shadow-sm rounded-3">
                    <div class="card-body p-4 p-md-5">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $erro)
                                        <li>{{ $erro }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('escolas.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" required>
                            </div>

                            <div class="mb-3">
                                <label for="bairro_id" class="form-label">Bairro</label>
                                <select class="form-select" id="bairro_id" name="bairro_id" required>
                                    <option value="">Selecione um Bairro</option>
                                    @foreach ($bairros as $bairro)
                                        <option value="{{ $bairro->id }}">{{ $bairro->nome }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="cidade-id" class="form-label">Cidade</label>
                                <select class="form-select" id="cidade-id" name="cidade-id" required>
                                    <option value="">Selecione uma Cidade</option>
                                    @foreach ($cidades as $cidade)
                                        <option value="{{ $cidade->id }}">{{ $cidade->nome }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Salvar Escola
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
