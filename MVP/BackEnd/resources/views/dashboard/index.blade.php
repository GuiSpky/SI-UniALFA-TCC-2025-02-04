@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid fade-in-up">

        {{-- Título --}}
        <h1 class="h2 fw-bold mb-4">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard Geral
        </h1>

        {{-- CARDS PRINCIPAIS --}}
        <div class="row g-4">

            <div class="col-md-4">
                <div class="card shadow-sm border-2 p-3">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-primary text-white p-3 me-3">
                            <i class="bi bi-journal-arrow-down fs-3"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0">{{ $totalConsumos }}</h5>
                            <small class="text-muted">Itens Consumidos</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-2 p-3">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-success text-white p-3 me-3">
                            <i class="bi bi-journal-text fs-3"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0">{{ $totalPedidos }}</h5>
                            <small class="text-muted">Pedidos Realizados</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-2 p-3">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-warning text-white p-3 me-3">
                            <i class="bi bi-egg fs-3"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0">{{ $totalProdutos }}</h5>
                            <small class="text-muted">Produtos Cadastrados</small>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        {{-- GRÁFICO 7 DIAS --}}
        <div class="card shadow-sm border-2 rounded-3 mt-4 p-4">
            <h5 class="fw-bold mb-3"><i class="bi bi-graph-up-arrow me-2"></i> Consumo dos Últimos 7 Dias</h5>
            <canvas id="graficoConsumo"></canvas>
        </div>


        {{-- MAIS CONSUMIDOS --}}
        <div class="card shadow-sm border-2 rounded-3 mt-4 p-4">
            <h5 class="fw-bold mb-3"><i class="bi bi-trophy me-2"></i> Produtos Mais Consumidos</h5>

            @if ($maisConsumidos->isEmpty())
                <p class="text-muted">Nenhum consumo registrado ainda.</p>
            @else
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Total Consumido</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($maisConsumidos as $item)
                            <tr>
                                <td>{{ $item->produto->nome ?? 'Produto não encontrado' }}</td>
                                <td><span class="badge bg-primary">{{ $item->total }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>


        {{-- LOTES PRESTES A VENCER --}}
        <div class="card shadow-sm border-2 rounded-3 mt-4 p-4">
            <h5 class="fw-bold mb-3 text-danger"><i class="bi bi-exclamation-triangle me-2"></i> Lotes a Vencer</h5>

            @if ($lotesVencendo->isEmpty())
                <p class="text-muted">Nenhum lote prestes a vencer.</p>
            @else
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Lote</th>
                            <th>Validade</th>
                            <th>Saldo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lotesVencendo as $e)
                            <tr>
                                <td>{{ $e->produto->nome }}</td>
                                <td>{{ $e->id }}</td>
                                <td>{{ date('d/m/Y', strtotime($e->validade)) }}</td>
                                <td>{{ $e->quantidade_saldo }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

    </div>


    {{-- GRÁFICO JS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('graficoConsumo').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($consumoDias->pluck('dia')) !!},
                datasets: [{
                    label: 'Quantidade Consumida',
                    data: {!! json_encode($consumoDias->pluck('total')) !!},
                    borderWidth: 3,
                    tension: 0.3
                }]
            }
        });
    </script>

@endsection
