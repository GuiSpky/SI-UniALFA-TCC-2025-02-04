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
            @if(in_array(Auth::user()->cargo, [1, 4]))
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
                        @if(in_array(Auth::user()->cargo, [1, 4]))
                            <th class="text-end">Ações</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($consumos as $consumo)
                        <tr>
                            <td>{{ $consumo->id }}</td>
                            <td>
                                @foreach ($consumo->itens as $item)
                                    {{ $item->itemProduto->produto->nome ?? 'N/A' }}<br>
                                @endforeach
                            </td>
                            <td>
                                <i class="bi bi-calendar me-2"></i>{{ \Carbon\Carbon::parse($consumo->data)->format('d/m/Y') }}
                            </td>
                            @if(in_array(Auth::user()->cargo, [1, 4]))
                                <td class="text-end">
                                    <a href="{{ route('consumos.edit', $consumo->id) }}" class="btn btn-outline-primary btn-sm" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('consumos.destroy', $consumo->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm" type="submit"
                                            onclick="return confirm('Deseja realmente apagar este consumo?')" title="Apagar">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            @endif
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
</div>
@endsection
