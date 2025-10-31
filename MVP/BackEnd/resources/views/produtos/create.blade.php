@extends('layouts.app')

@section('title', 'Novo Produto')

@section('content')

    <div class="container-fluid py-4">
        <div class="mb-4 fade-in-up">
            <div class="d-flex align-items-center mb-3">
                <a href="{{ route('produtos.index') }}" class="btn btn-outline-secondary btn-sm me-3">
                    <i class="bi bi-arrow-left me-2"></i>Voltar
                </a>
                <div>
                    <h1 class="h2 fw-bold mb-1"><i class="bi bi-person-plus-fill me-2"></i>Novo Produto</h1>
                    <p class="text-muted mb-0">Preencha os dados para cadastrar um novo produto</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card fade-in-up shadow-sm border-0">
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
                        <form action="{{ route('produtos.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" required>
                            </div>

                            <div class="mb-3">
                                <label for="grupo" class="form-label">Grupo Alimentício</label>
                                <select class="form-select" id="grupo" name="grupo" required>
                                    <option value="">Selecione Grupo</option>
                                        <option value="carboidratos">Carboidratos</option>
                                        <option value="proteínas">Proteínas</option>
                                        <option value="oleogenosos">Oleogenosos</option>
                                        <option value="fibras">Fibras</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Salvar Produto
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
