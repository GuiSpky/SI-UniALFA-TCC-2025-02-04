@extends('layouts.app')

@section('title', 'Novo Cardápio')

@section('content')

    <div class="container-fluid py-4">
        <div class="mb-4 fade-in-up">
            <div class="d-flex align-items-center mb-3">
                <a href="{{ route('cardapios.index') }}" class="btn btn-outline-secondary btn-sm me-3">
                    <i class="bi bi-arrow-left me-2"></i>Voltar
                </a>
                <div>
                    <h1 class="h2 fw-bold mb-1"><i class="bi bi-list-ul me-2"></i>Novo Cardápio</h1>
                    <p class="text-muted mb-0">Preencha os dados para cadastrar um novo cardápio</p>
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
                        <form action="{{ route('cardapios.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="receita" class="form-label">Receita</label>
                                <input type="text" class="form-control" id="receita" name="receita" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Itens do Cardápio</label>
                                <div id="itens-container">
                                    <div class="input-group mb-2">
                                        <select name="produtos[]" class="form-select" required>
                                            <option value="">Selecione um produto</option>
                                            @foreach ($produtos as $produto)
                                                <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn btn-outline-success add-item">+</button>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="data" class="form-label">Data</label>
                                <input type="date" class="form-control" id="data" name="data" required>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Salvar Cardápio
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('add-item')) {
                e.preventDefault();

                const container = document.getElementById('itens-container');
                const newItem = document.createElement('div');
                newItem.classList.add('input-group', 'mb-2');

                newItem.innerHTML = `
            <select name="produtos[]" class="form-select" required>
                <option value="">Selecione um produto</option>
                @foreach ($produtos as $produto)
                    <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                @endforeach
            </select>
            <button type="button" class="btn btn-outline-danger remove-item">−</button>
        `;

                container.appendChild(newItem);
            }

            if (e.target.classList.contains('remove-item')) {
                e.preventDefault();
                e.target.closest('.input-group').remove();
            }
        });
    </script>
@endsection
