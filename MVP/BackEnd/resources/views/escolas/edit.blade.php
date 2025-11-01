@extends('layouts.app')

@section('title', 'Editar Escola')

@section('content')

    <div class="container-fluid py-4">
        <div class="mb-4 fade-in-up">
            <div class="d-flex align-items-center mb-3">
                <a href="{{ route('escolas.index') }}" class="btn btn-outline-secondary btn-sm me-3">
                    <i class="bi bi-arrow-left me-2"></i>Voltar
                </a>
                <div>
                    <h1 class="h2 fw-bold mb-1"><i class="bi bi-pencil-square me-2"></i>Editar Escola</h1>
                    <p class="text-muted mb-0">Atualize os dados da Escola</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card fade-in-up border-2 shadow-sm rounded-3">
                    <div class="card-body p-4 p-md-5">

                        <form action="{{ route('escolas.update', $escola->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- Mensagens de erro --}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            {{-- Nome --}}
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome"
                                    value="{{ old('nome', $escola->nome) }}" required>
                            </div>

                            {{-- Bairro --}}
                            <div class="mb-3">
                                <label for="id_bairro" class="form-label">Bairro</label>
                                <select name="id_bairro" id="id_bairro" class="form-select" required>
                                    <option value="">Selecione um Bairro</option>
                                    @foreach ($bairros as $bairro)
                                        <option value="{{ $bairro->id }}"
                                            {{ old('id_bairro', $escola->id_bairro) == $bairro->id ? 'selected' : '' }}>
                                            {{ $bairro->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Cidade --}}
                            <div class="mb-3">
                                <label for="id_cidade" class="form-label">Cidade</label>
                                <select name="id_cidade" id="id_cidade" class="form-select" required>
                                    <option value="">Selecione uma Cidade</option>
                                    @foreach ($cidades as $cidade)
                                        <option value="{{ $cidade->id }}"
                                            {{ old('id_cidade', $escola->id_cidade) == $cidade->id ? 'selected' : '' }}>
                                            {{ $cidade->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Botões --}}
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('escolas.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle me-2"></i>Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-2"></i>Atualizar Escola
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
