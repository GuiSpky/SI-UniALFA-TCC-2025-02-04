@extends('layouts.app')

@section('title', 'Editar Produto')

@section('content')

<div class="container-fluid py-4">
    <div class="mb-4 fade-in-up">
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route('produtos.index') }}" class="btn btn-outline-secondary btn-sm me-3">
                <i class="bi bi-arrow-left me-2"></i>Voltar
            </a>
            <div>
                <h1 class="h2 fw-bold mb-1"><i class="bi bi-pencil-square me-2"></i>Editar Produto</h1>
                <p class="text-muted mb-0">Atualize os dados do produto</p>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card fade-in-up border-2 shadow-sm rounded-3">
                <div class="card-body p-4 p-md-5">

                    <form action="{{ route('produtos.update', $produto->id) }}" method="POST">
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
                            <input 
                                type="text" 
                                class="form-control" 
                                id="nome" 
                                name="nome"
                                value="{{ old('nome', $produto->nome) }}" 
                                required
                            >
                        </div>


                            {{-- UF --}}
                            <div class="mb-3">
                                <label>Selecione o Grupo</label>
                                <select name="grupo" class="form-control" required>
                                    <option value="">-- Escolha uma classe --</option>
                                    <option value="proteina">Proteina</option>
                                    <option value="carboidratos">Carboidratos</option>
                                    <option value="oleogenosos">Oleogenosos</option>
                                    <option value="fibras">Fibras</option>
                                </select>
                            </div>


                        {{-- Botões --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('produtos.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Atualizar Produto
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
