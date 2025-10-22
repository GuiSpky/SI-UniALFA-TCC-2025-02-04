@extends('layouts.app')
@section('title', 'Lista de Bairros')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="mb-4 fade-in-up">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h1 class="h2 fw-bold mb-1" style="color: #ffffff;">
                    <i class="bi bi-map me-2"></i>Bairros
                </h1>
                <p class="text-muted mb-0">Gerencie todos os bairros do sistema</p>
            </div>
            <a href="{{ route('bairros.create') }}" class="btn btn-primary btn-lg" style="background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%); border: none; transition: all 0.3s ease;">
                <i class="bi bi-plus-circle me-2"></i>Novo Bairro
            </a>
        </div>
    </div>

    <!-- Table Section -->
    <div class="card" style="background-color: #252535; border: 1px solid #2a2a3e; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);">
        <div class="table-responsive">
            <table class="table table-hover mb-0" style="color: #ffffff;">
                <thead style="background-color: #1a1a2e; border-bottom: 2px solid #2a2a3e;">
                    <tr>
                        <th style="color: #b0b0b0; font-weight: 600; padding: 1rem;">ID</th>
                        <th style="color: #b0b0b0; font-weight: 600; padding: 1rem;">Nome</th>
                        <th style="color: #b0b0b0; font-weight: 600; padding: 1rem;">Cidade</th>
                        <th style="color: #b0b0b0; font-weight: 600; padding: 1rem; text-align: center;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bairros as $bairro)
                        <tr style="border-bottom: 1px solid #2a2a3e; transition: all 0.3s ease;">
                            <td style="padding: 1rem;">
                                <span class="badge" style="background-color: #0d6efd; color: white; padding: 0.5rem 0.75rem; border-radius: 6px;">
                                    {{ $bairro->id }}
                                </span>
                            </td>
                            <td style="padding: 1rem;">
                                <a href="{{route('bairro.show', $bairro)}}" style="color: #0dcaf0; text-decoration: none; transition: all 0.3s ease; font-weight: 500;">
                                    {{ $bairro->nome }}
                                </a>
                            </td>
                            <td style="padding: 1rem; color: #b0b0b0;">
                                <i class="bi bi-geo-alt me-2" style="color: #0dcaf0;"></i>{{ $cidades->where('id', $bairro->id_cidade)->pluck('nome')->first() ?? 'N/A' }}
                            </td>
                            <td style="padding: 1rem; text-align: center;">
                                <div class="btn-group" role="group">
                                    <a href="{{route('bairros.edit', $bairro->id)}}" class="btn btn-sm" style="background-color: #1a5f7a; color: #0dcaf0; border: 1px solid #0dcaf0; transition: all 0.3s ease; border-radius: 6px; margin-right: 0.5rem;" title="Editar">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{route('bairros.destroy', $bairro)}}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm" style="background-color: #7a1a1a; color: #ff6b6b; border: 1px solid #ff6b6b; transition: all 0.3s ease; border-radius: 6px;" type="submit" onclick="return confirm('Deseja realmente apagar este bairro?')" title="Apagar">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <i class="bi bi-inbox" style="font-size: 3rem; color: #b0b0b0; margin-bottom: 1rem;"></i>
                                <p style="color: #b0b0b0; margin-top: 1rem;">Nenhum bairro encontrado</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    tbody tr:hover {
        background-color: #16213e !important;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    a:hover {
        text-decoration: underline;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-in-up {
        animation: fadeInUp 0.6s ease-out;
    }
</style>
@endsection

