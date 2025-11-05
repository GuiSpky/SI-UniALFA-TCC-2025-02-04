@extends('layouts.app')

@section('title', 'Relatórios Estratégicos')

@section('content')
<div class="container-fluid py-4">
    <h1 class="h3 mb-4 fw-bold"><i class="bi bi-clipboard-data me-2"></i>Relatórios Estratégicos</h1>

    <div class="card shadow-sm border-0 fade-in-up">
        <div class="card-body p-4">
            <form action="{{ route('relatorios.resultado') }}" method="GET" id="formRelatorio">

                {{-- Tipo de Relatório --}}
                <div class="mb-3">
                    <label for="tipo" class="form-label">Tipo de Relatório</label>
                    <select name="tipo" id="tipo" class="form-select" required>
                        <option value="">Selecione um tipo</option>
                        <option value="consumo_escolas">Consumo por Escola</option>
                        <option value="solicitacoes_produtos">Produtos Mais Solicitados</option>
                        <option value="estoque_critico">Estoque</option>
                    </select>
                </div>

                {{-- Filtros comuns --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="data_inicio" class="form-label">Data Inicial</label>
                        <input type="date" name="data_inicio" id="data_inicio" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="data_fim" class="form-label">Data Final</label>
                        <input type="date" name="data_fim" id="data_fim" class="form-control">
                    </div>
                </div>

                {{-- Filtros específicos --}}
                <div class="filtro-consumo-escolas d-none">
                    <div class="mb-3">
                        <label for="escola_id" class="form-label">Escola</label>
                        <select name="escola_id" id="escola_id" class="form-select">
                            <option value="">Todas</option>
                            @foreach ($escolas as $escola)
                                <option value="{{ $escola->id }}">{{ $escola->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="produto_id" class="form-label">Produto</label>
                        <select name="produto_id" id="produto_id" class="form-select">
                            <option value="">Todos</option>
                            @foreach ($produtos as $produto)
                                <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="filtro-solicitacoes-produtos d-none">
                    <div class="mb-3">
                        <label for="limite" class="form-label">Limitar resultados</label>
                        <input type="number" name="limite" id="limite" class="form-control" placeholder="Ex: 10">
                    </div>
                </div>

                <div class="filtro-estoque-critico d-none">
                    <div class="mb-3">
                        <label for="limite_estoque" class="form-label">Estoque abaixo de</label>
                        <input type="number" name="limite_estoque" id="limite_estoque" class="form-control" placeholder="Ex: 50">
                    </div>
                </div>

                {{-- Botão --}}
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-bar-chart-line me-2"></i>Gerar Relatório
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const tipoSelect = document.getElementById('tipo');
    tipoSelect.addEventListener('change', () => {
        document.querySelectorAll('[class^="filtro-"]').forEach(el => el.classList.add('d-none'));
        document.querySelector(`.filtro-${tipoSelect.value.replace('_', '-')}`)?.classList.remove('d-none');
    });
</script>
@endsection
