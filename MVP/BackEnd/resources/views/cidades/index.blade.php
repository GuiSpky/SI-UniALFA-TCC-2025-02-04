@extends('layouts.app')

@section('title', 'Lista de Cidades')

@section('content')
<div class="container-fluid">
    <div class="mb-4 fade-in-up">
        <div class="d-flex align-items-center mb-3">
            <div>
                <h1 class="h2 fw-bold mb-1"><i class="bi bi-geo-alt me-2"></i>Cidades</h1>
                <p class="text-muted mb-0">Gerencie as cidades cadastradas no sistema</p>
            </div>
            <a href="{{ route('cidades.create') }}" class="btn btn-primary btn-sm ms-auto shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> Nova Cidade
            </a>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead>
                    <tr class="table-light text-uppercase small fw-bold">
                        <th>Cod. IBGE</th>
                        <th>Nome</th>
                        <th>UF</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cidades as $cidade)
                        <tr>
                            <td>
                                <span class="badge bg-primary">
                                    {{ $cidade->codIbge }}
                                </span>
                            </td>
                            <td>
                                <a href="{{route('cidade.show', $cidade)}}">
                                    {{ $cidade->nome }}
                                </a>
                            </td>
                            <td>
                                <span class="badge bg-secondary">
                                    {{ $cidade->uf }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="{{route('cidades.edit', $cidade->id)}}" class="btn btn-outline-primary btn-sm" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{route('cidades.destroy', $cidade)}}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm" type="submit" onclick="return confirm('Deseja realmente apagar esta cidade?')" title="Apagar">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                                <p class="text-muted">Nenhuma cidade encontrada</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

