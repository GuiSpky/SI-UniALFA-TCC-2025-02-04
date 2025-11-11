@extends('layouts.app')

@section('title', 'Editar Entrada')

@section('content')

<div class="container-fluid py-4">
    <div class="mb-4 fade-in-up">
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route('itemProdutos.index') }}" class="btn btn-outline-secondary btn-sm me-3">
                <i class="bi bi-arrow-left me-2"></i>Voltar
            </a>
            <div>
                <h1 class="h2 fw-bold mb-1"><i class="bi bi-pencil-square me-2"></i>Editar Entrada</h1>
                <p class="text-muted mb-0">Atualize as informações da entrada selecionada</p>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card fade-in-up shadow-sm border-0">
                <div class="card-body p-4 p-md-5">
                    {{-- Exibir erros de validação --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $erro)
                                    <li>{{ $erro }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Formulário de edição --}}
                    <form action="{{ route('itemProdutos.update', $itemProduto->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Produto --}}
                        <div class="mb-3">
                            <label for="id_produto" class="form-label">Produto</label>
                            <select class="form-select" id="id_produto" name="id_produto" required>
                                <option value="">Selecione o produto</option>
                                @foreach ($produtos as $produto)
                                    <option
                                        value="{{ $produto->id }}"
                                        {{ old('id_produto', $itemProduto->id_produto) == $produto->id ? 'selected' : '' }}>
                                        {{ $produto->nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Quantidade --}}
                        <div class="mb-3">
                            <label for="quantidade_entrada" class="form-label">Quantidade ({{ $produtos->where('id', $itemProduto->id_produto)->pluck('medida')->first() ?? 'N/A' }})</label>
                            <input
                                type="number"
                                class="form-control"
                                id="quantidade_entrada"
                                name="quantidade_entrada"
                                value="{{ old('quantidade_entrada', $itemProduto->quantidade_entrada) }}"
                                required>
                        </div>

                        {{-- Validade --}}
                        <div class="mb-3">
                            <label for="validade" class="form-label">Validade</label>
                            <input
                                type="date"
                                class="form-control"
                                id="validade"
                                name="validade"
                                value="{{ old('validade', $itemProduto->validade) }}"
                                required>
                        </div>

                        {{-- Armazém (Escola) --}}
                        <div class="mb-3">
                            <label for="id_escola" class="form-label">Armazém</label>
                            <select class="form-select" id="id_escola" name="id_escola" required>
                                <option value="">Selecione o Armazém</option>
                                @foreach ($escolas as $escola)
                                    <option
                                        value="{{ $escola->id }}"
                                        {{ old('id_escola', $itemProduto->id_escola) == $escola->id ? 'selected' : '' }}>
                                        {{ $escola->nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Botões --}}
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-2"></i>Salvar Alterações
                        </button>
                        <a href="{{ route('itemProdutos.index') }}" class="btn btn-secondary ms-2">
                            <i class="bi bi-x-circle me-1"></i>Cancelar
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
