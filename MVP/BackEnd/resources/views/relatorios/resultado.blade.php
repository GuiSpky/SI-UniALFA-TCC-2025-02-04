@extends('layouts.app')

@section('title', $titulo)

@section('content')
<div class="container-fluid py-4">
    <h1 class="h3 mb-4 fw-bold"><i class="bi bi-graph-up me-2"></i>{{ $titulo }}</h1>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <canvas id="graficoRelatorio" height="100"></canvas>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-striped table-hover align-middle">
                <thead>
                    <tr>
                        @foreach (array_keys((array) $dados->first() ?? []) as $coluna)
                            <th>{{ ucfirst($coluna) }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dados as $linha)
                        <tr>
                            @foreach ($linha as $valor)
                                <td>{{ $valor }}</td>
                            @endforeach
                        </tr>
                    @empty
                        <tr><td colspan="10" class="text-center text-muted">Nenhum dado encontrado.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('graficoRelatorio').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($labels),
            datasets: [{
                label: '{{ $titulo }}',
                data: @json($valores),
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgb(54, 162, 235)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: { y: { beginAtZero: true } }
        }
    });
</script>
@endsection
