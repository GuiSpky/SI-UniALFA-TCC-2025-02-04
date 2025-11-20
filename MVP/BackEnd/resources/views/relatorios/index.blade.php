@extends('layouts.app')

@section('title', 'Relatórios Estratégicos')

@section('content')
<div class="container-fluid py-4">

    <h1 class="h3 mb-4 fw-bold"><i class="bi bi-clipboard-data me-2"></i>Relatórios Estratégicos</h1>

    {{-- ========================= --}}
    {{-- FILTROS AVANÇADOS --}}
    {{-- ========================= --}}
    <div class="card shadow-sm border-0 fade-in-up mb-4">
        <div class="card-body p-4">

            <form action="{{ route('relatorios.index') }}" method="GET" id="formRelatorio">

                {{-- Tipo de Relatório --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Tipo de Relatório</label>
                    <select name="tipo" id="tipo" class="form-select" required>
                        <option value="">Selecione</option>
                        <option value="consumo_escolas" {{ request('tipo')=='consumo_escolas'?'selected':'' }}>
                            Consumo por Escola
                        </option>
                        <option value="solicitacoes_produtos" {{ request('tipo')=='solicitacoes_produtos'?'selected':'' }}>
                            Produtos Mais Solicitados
                        </option>
                        <option value="estoque_critico" {{ request('tipo')=='estoque_critico'?'selected':'' }}>
                            Estoque Crítico / Vencimentos
                        </option>
                    </select>
                </div>

                {{-- PERÍODO --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Data Inicial</label>
                        <input type="date" class="form-control" name="data_inicio" value="{{ request('data_inicio') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Data Final</label>
                        <input type="date" class="form-control" name="data_fim" value="{{ request('data_fim') }}">
                    </div>

                    {{-- <div class="col-md-2">
                        <label class="form-label">Mês</label>
                        <select name="mes" class="form-select">
                            <option value="">—</option>
                            @foreach(range(1,12) as $m)
                                <option value="{{ $m }}" {{ request('mes')==$m?'selected':'' }}>{{ $m }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Ano</label>
                        <select name="ano" class="form-select">
                            <option value="">—</option>
                            @foreach(range(now()->year-5, now()->year) as $ano)
                                <option value="{{ $ano }}" {{ request('ano')==$ano?'selected':'' }}>{{ $ano }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                </div>

                {{-- ========================= --}}
                {{-- FILTROS — CONSUMO POR ESCOLA --}}
                {{-- ========================= --}}
                <div class="filtro-consumo_escolas d-none">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Escola</label>
                            <select name="escola_id" class="form-select">
                                <option value="">Todas</option>
                                @foreach ($escolas as $escola)
                                <option value="{{ $escola->id }}"
                                    {{ request('escola_id')==$escola->id?'selected':'' }}>
                                    {{ $escola->nome }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Produto</label>
                            <select name="produto_id" class="form-select">
                                <option value="">Todos</option>
                                @foreach ($produtos as $produto)
                                <option value="{{ $produto->id }}"
                                    {{ request('produto_id')==$produto->id?'selected':'' }}>
                                    {{ $produto->nome }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>


                {{-- ========================= --}}
                {{-- FILTROS — PRODUTOS MAIS SOLICITADOS --}}
                {{-- ========================= --}}
                <div class="filtro-solicitacoes_produtos d-none">

                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">TOP N Produtos</label>
                            <input type="number" name="limite" class="form-control" placeholder="Ex: 10"
                                value="{{ request('limite') }}">
                        </div>

                    </div>
                </div>


                {{-- ========================= --}}
                {{-- FILTROS — ESTOQUE CRÍTICO --}}
                {{-- ========================= --}}
                <div class="filtro-estoque_critico d-none">
                    <div class="row">

                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Quantidade abaixo de</label>
                            <input type="number" name="limite_estoque" class="form-control" placeholder="Ex: 30"
                                value="{{ request('limite_estoque') }}">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Mostrar vencidos?</label>
                            <select name="vencidos" class="form-select">
                                <option value="">Não</option>
                                <option value="1" {{ request('vencidos')=='1'?'selected':'' }}>Sim</option>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Vencendo em X dias</label>
                            <input type="number" name="vencendo_dias" class="form-control" placeholder="Ex: 7"
                                value="{{ request('vencendo_dias') }}">
                        </div>

                    </div>
                </div>

                {{-- BOTÕES --}}
                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search me-2"></i>Gerar Relatório
                    </button>

                    @if(isset($dados) && count($dados) > 0)
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
    {{-- TABELA DE RESULTADOS --}}
    {{-- ========================= --}}
    @if(isset($titulo) && $titulo && $dados->count() > 0)

    <h4 class="mt-4 fw-bold">{{ $titulo }}</h4>

    <div class="table-responsive mt-3">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    @foreach(array_keys((array)$dados->first()) as $coluna)
                    <th class="text-uppercase small">{{ ucfirst(str_replace('_', ' ', $coluna)) }}</th>
                    @endforeach
                </tr>
            </thead>

            <tbody>
                @foreach($dados as $linha)
                <tr>
                    @foreach((array)$linha as $valor)
                    <td>{{ $valor }}</td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @elseif(isset($titulo))
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
    if (tipo) {
        document.querySelector('.filtro-' + tipo)?.classList.remove('d-none');
    }
}

atualizarFiltros();
tipoSelect.addEventListener('change', atualizarFiltros);
</script>

@endsection
