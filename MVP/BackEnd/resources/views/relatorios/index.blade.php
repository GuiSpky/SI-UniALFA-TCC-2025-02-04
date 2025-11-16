@extends('layouts.app')

@section('title', 'Relatórios Estratégicos')

@section('content')
    <div class="container-fluid py-4">

        <h1 class="h3 mb-4 fw-bold"><i class="bi bi-clipboard-data me-2"></i>Relatórios Estratégicos</h1>

        {{-- ========================= --}}
        {{-- FILTROS DO RELATÓRIO --}}
        {{-- ========================= --}}
        <div class="card shadow-sm border-0 fade-in-up mb-4">
            <div class="card-body p-4">

                <form action="{{ route('relatorios.index') }}" method="GET" id="formRelatorio">

                    {{-- Tipo de Relatório --}}
                    <div class="mb-3">
                        <label class="form-label">Tipo de Relatório</label>
                        <select name="tipo" id="tipo" class="form-select" required>
                            <option value="">Selecione</option>
                            <option value="consumo_escolas" {{ request('tipo') == 'consumo_escolas' ? 'selected' : '' }}>Consumo
                                por Escola</option>
                            <option value="solicitacoes_produtos"
                                {{ request('tipo') == 'solicitacoes_produtos' ? 'selected' : '' }}>Produtos Mais Solicitados
                            </option>
                            <option value="estoque_critico" {{ request('tipo') == 'estoque_critico' ? 'selected' : '' }}>Estoque
                                Crítico</option>
                        </select>
                    </div>

                    {{-- Período --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Data Inicial</label>
                            <input type="date" class="form-control" name="data_inicio"
                                value="{{ request('data_inicio') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Data Final</label>
                            <input type="date" class="form-control" name="data_fim" value="{{ request('data_fim') }}">
                        </div>
                    </div>

                    {{-- Filtro por Escola e Produto --}}
                    <div class="filtro-consumo_escolas d-none">
                        <div class="mb-3">
                            <label class="form-label">Escola</label>
                            <select name="escola_id" class="form-select">
                                <option value="">Todas</option>
                                @foreach ($escolas as $escola)
                                    <option value="{{ $escola->id }}"
                                        {{ request('escola_id') == $escola->id ? 'selected' : '' }}>
                                        {{ $escola->nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Produto</label>
                            <select name="produto_id" class="form-select">
                                <option value="">Todos</option>
                                @foreach ($produtos as $produto)
                                    <option value="{{ $produto->id }}"
                                        {{ request('produto_id') == $produto->id ? 'selected' : '' }}>
                                        {{ $produto->nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Produtos mais solicitados --}}
                    <div class="filtro-solicitacoes_produtos d-none">
                        <label class="form-label">Top N Produtos</label>
                        <input type="number" name="limite" class="form-control" placeholder="Ex: 10"
                            value="{{ request('limite') }}">
                    </div>

                    {{-- Estoque crítico --}}
                    <div class="filtro-estoque_critico d-none">
                        <label class="form-label">Quantidade abaixo de:</label>
                        <input type="number" name="limite_estoque" class="form-control" placeholder="Ex: 30"
                            value="{{ request('limite_estoque') }}">
                    </div>

                    {{-- Botões --}}
                    <div class="d-flex justify-content-between mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search me-2"></i>Gerar Relatório
                        </button>

                        @if (isset($dados) && count($dados) > 0)
                            <div class="btn-group">
                                <a href="{{ route('relatorios.exportar.pdf', request()->query()) }}"
                                    class="btn btn-danger">
                                    <i class="bi bi-filetype-pdf me-1"></i>PDF
                                </a>
                                <a href="{{ route('relatorios.exportar.excel', request()->query()) }}"
                                    class="btn btn-success">
                                    <i class="bi bi-file-earmark-excel me-1"></i>Excel
                                </a>
                            </div>
                        @endif
                    </div>

                </form>
            </div>
        </div>


        {{-- ========================= --}}
        {{-- VISUALIZAÇÃO DO RELATÓRIO --}}
        {{-- ========================= --}}
        @if ($titulo && $dados->count() > 0)

            <h4 class="mt-4 fw-bold">{{ $titulo }}</h4>

            <div class="table-responsive mt-3">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            @foreach (array_keys((array) $dados->first()) as $coluna)
                                <th class="text-uppercase small">{{ ucfirst(str_replace('_', ' ', $coluna)) }}</th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($dados as $linha)
                            <tr>
                                @foreach ((array) $linha as $valor)
                                    <td>{{ $valor }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @elseif ($titulo)
            <div class="alert alert-warning mt-4">
                Nenhum dado encontrado para os filtros selecionados.
            </div>
        @endif


    </div>

    <script>
        const tipoSelect = document.getElementById('tipo');
        const filtros = document.querySelectorAll('[class^="filtro-"]');

        function atualizarFiltros() {
            filtros.forEach(f => f.classList.add('d-none'));
            const tipo = tipoSelect.value;
            if (tipo) document.querySelector('.filtro-' + tipo)?.classList.remove('d-none');
        }

        // inicializa com base na URL
        atualizarFiltros();

        // quando trocar o tipo
        tipoSelect.addEventListener('change', atualizarFiltros);
    </script>

@endsection
