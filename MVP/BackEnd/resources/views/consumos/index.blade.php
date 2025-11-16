@extends('layouts.app')
@section('title', 'Lista de Consumos')

@section('content')
    <div class="container-fluid">
        <div class="mb-4 fade-in-up">
            <div class="d-flex align-items-center mb-3">
                <div>
                    <h1 class="h2 fw-bold mb-1"><i class="bi bi-journal-check me-2"></i>Consumos</h1>
                    <p class="text-muted mb-0">Gerencie os consumos no sistema</p>
                </div>
                @if (in_array(Auth::user()->cargo, [1, 2,4]))
                    <a href="{{ route('consumos.create') }}" class="btn btn-primary btn-sm ms-auto shadow-sm">
                        <i class="bi bi-plus-circle me-1"></i> Novo Consumo
                    </a>
                @endif
            </div>
        </div>

        <div class="card border-2 shadow-sm rounded-3">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 table-bordered">
                    <thead>
                        <tr class="text-uppercase small fw-bold">
                            <th>ID</th>
                            <th>Itens</th>
                            <th>Data de Saída</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($consumos as $consumo)
                            <tr>
                                <td>
                                    <a href="{{ route('consumos.show', $consumo) }}"
                                        class="badge bg-primary text-decoration-none id">
                                        #{{ str_pad($consumo->id, 4, '0', STR_PAD_LEFT) }}
                                    </a>
                                </td>
                                <td>
                                    @foreach ($consumo->itens as $item)
                                        @php
                                            $produto = $item->estoque->produto ?? null;
                                        @endphp

                                        {{ $produto?->nome ?? 'Produto não encontrado' }}
                                        ({{ $item->quantidade }} {{ $produto?->medida ?? '' }})
                                        <br>
                                    @endforeach
                                </td>
                                <td>
                                    <i class="bi bi-calendar me-2"></i>
                                    {{ $consumo->created_at->format('d/m/Y') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <i class="bi bi-inbox" style="font-size:3rem;"></i>
                                    <p class="text-muted mt-2">Nenhum consumo encontrado</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
            <!-- Itens por página (à esquerda) -->
            <form method="GET" class="d-flex align-items-center mb-2 mb-md-0">
                <label for="per_page" class="me-2 mb-0 fw-semibold">Itens por página:</label>
                <select name="per_page" id="per_page" class="form-select form-select-sm w-auto"
                    onchange="this.form.submit()">
                    @foreach ([10, 20, 50, 100] as $size)
                        <option value="{{ $size }}" {{ $perPage == $size ? 'selected' : '' }}>
                            {{ $size }}
                        </option>
                    @endforeach
                </select>
            </form>

            <!-- Pesquisa (centralizada) -->
            <div class="flex-grow-1 text-center">
                <!-- Paginação -->
                @if ($consumos->hasPages())
                    <div class="card-footer d-flex justify-content-center py-3">
                        {{ $consumos->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
