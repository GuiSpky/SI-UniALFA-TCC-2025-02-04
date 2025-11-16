@extends('layouts.app')

@section('title', 'Nova Entrada')

@section('content')

<div class="container-fluid py-4">
    <div class="mb-4 fade-in-up">
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route('estoques.index') }}" class="btn btn-outline-secondary btn-sm me-3">
                <i class="bi bi-arrow-left me-2"></i>Voltar
            </a>
            <div>
                <h1 class="h2 fw-bold mb-1"><i class="bi bi-box-arrow-in-down me-2"></i>Nova Entrada</h1>
                <p class="text-muted mb-0">Preencha os dados para cadastrar uma nova entrada</p>
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

                    <form action="{{ route('estoques.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="produto_id" class="form-label">Produto</label>
                            <select class="form-select" id="produto_id" name="produto_id" required>
                                <option value="">Selecione o produto</option>
                                @foreach ($produtos as $produto)
                                    <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="quantidade_entrada" class="form-label">Quantidade</label>
                            <input type="number" class="form-control" id="quantidade_entrada" name="quantidade_entrada" required>
                        </div>

                        <div class="mb-3">
                            <label for="validade" class="form-label">Validade</label>
                            <input type="date" class="form-control" id="validade" name="validade" required>
                        </div>

                        @if (Auth::user()->cargo == 1)
                            <div class="mb-3">
                                <label for="escola_id" class="form-label">Armazém</label>
                                <select class="form-select" id="escola_id" name="escola_id" required>
                                    <option value="">Selecione o Armazém</option>
                                    @foreach ($escolas as $escola)
                                        <option value="{{ $escola->id }}">{{ $escola->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <input type="hidden" name="escola_id" value="{{ Auth::user()->escola_id }}">
                        @endif

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-2"></i>Salvar Entrada
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
