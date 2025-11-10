@extends('layouts.app')

@section('title', 'Novo Consumo')

@section('content')
    <div class="container-fluid py-4">
        <div class="mb-4 fade-in-up">
            <div class="d-flex align-items-center mb-3">
                <a href="{{ route('consumos.index') }}" class="btn btn-outline-secondary btn-sm me-3">
                    <i class="bi bi-arrow-left me-2"></i>Voltar
                </a>
                <div>
                    <h1 class="h2 fw-bold mb-1"><i class="bi bi-person-plus-fill me-2"></i>Novo Consumo</h1>
                    <p class="text-muted mb-0">Preencha os dados para cadastrar o consumo</p>
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

                        <form action="{{ route('consumos.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Itens do Consumo</label>
                                <div id="itens-container">
                                    <div class="input-group mb-2">
                                        <select name="produtos[]" class="form-select" required>
                                            <option value="">Selecione um produto</option>
                                            @foreach ($produtos as $produto)
                                                <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                                            @endforeach
                                        </select>
                                        <input type="number" name="quantidades[]" class="form-control" placeholder="Qtd"
                                            min="1" required>
                                        <button type="button" class="btn btn-outline-success add-item">+</button>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Salvar Consumo
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
                    <input type="number" name="quantidades[]" class="form-control" placeholder="Qtd" min="1" required>
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
