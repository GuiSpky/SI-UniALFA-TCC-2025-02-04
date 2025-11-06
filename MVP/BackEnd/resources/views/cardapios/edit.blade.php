@extends('layouts.app')

@section('title', 'Editar Cardápio')

@section('content')
    <div class="container-fluid py-4">
        <div class="mb-4 fade-in-up">
            <div class="d-flex align-items-center mb-3">
                <a href="{{ route('cardapios.index') }}" class="btn btn-outline-secondary btn-sm me-3">
                    <i class="bi bi-arrow-left me-2"></i>Voltar
                </a>
                <div>
                    <h1 class="h2 fw-bold mb-1"><i class="bi bi-pencil-square me-2"></i>Editar Cardápio</h1>
                    <p class="text-muted mb-0">Atualize as informações do cardápio e seus produtos</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card fade-in-up border-2 shadow-sm rounded-3">
                    <div class="card-body p-4 p-md-5">

                        <form action="{{ route('cardapios.update', $cardapio->id) }}" method="POST">
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

                            {{-- Nome da Receita --}}
                            <div class="mb-3">
                                <label for="receita" class="form-label">Receita</label>
                                <input type="text" class="form-control" id="receita" name="receita"
                                    value="{{ old('receita', $cardapio->receita) }}" required>
                            </div>

                            {{-- Data --}}
                            <div class="mb-3">
                                <label for="data" class="form-label">Data</label>
                                <input type="date" class="form-control" id="data" name="data"
                                    value="{{ old('data', $cardapio->data) }}" required>
                            </div>

                            {{-- Itens (Produtos do Cardápio) --}}
                            <div class="mb-3">
                                <label for="produtos" class="form-label">Produtos do Cardápio</label>
                                <div class="border rounded p-3 bg-light">
                                    @foreach ($produtos as $produto)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="produtos[]"
                                                value="{{ $produto->id }}"
                                                id="produto_{{ $produto->id }}"
                                                {{ in_array($produto->id, $cardapio->itens->pluck('id_produto')->toArray()) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="produto_{{ $produto->id }}">
                                                {{ $produto->nome }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Botões --}}
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('cardapios.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle me-2"></i>Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-2"></i>Atualizar Cardápio
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
