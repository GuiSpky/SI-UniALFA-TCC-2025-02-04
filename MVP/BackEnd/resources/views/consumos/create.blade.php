@extends('layouts.app')

@section('title', 'Novo Consumo')

@section('content')
    <div class="container-fluid">
        <div class="fade-in-up mb-4">
            <div class="d-flex align-items-center mb-3">
                <div>
                    <h1 class="h2 fw-bold mb-1">
                        <i class="bi bi-lightning-charge-fill me-2"></i>Novo Consumo
                    </h1>
                    <p class="text-muted mb-0">Selecione os lotes e quantidades consumidas</p>
                </div>
            </div>
        </div>

        <div class="card border-2 shadow-sm rounded-3 p-4">
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

                <table class="table table-bordered align-middle">
                    <thead>
                        <tr class="text-uppercase small fw-bold">
                            <th>Lote / Produto</th>
                            <th style="width: 150px;">Quantidade</th>
                            <th style="width: 50px;">Ações</th>
                        </tr>
                    </thead>

                    <tbody id="itens-tabela">

                        {{-- Primeira linha --}}
                        <tr>
                            <td>
                                <select name="estoques[]" class="form-select" required>
                                    <option value="">Selecione um lote</option>
                                    @foreach ($estoques as $e)
                                        <option value="{{ $e->id }}">
                                            {{ $e->produto->nome }} — Lote {{ $e->id }}
                                            — Val: {{ date('d/m/Y', strtotime($e->validade)) }}
                                            — Saldo: {{ $e->quantidade_saldo }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>

                            <td>
                                <input type="number" name="quantidades[]" class="form-control" min="1" required>
                            </td>

                            <td class="text-center">
                                <button type="button" class="btn btn-danger btn-sm remove-item">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>

                    </tbody>
                </table>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <button type="button" id="add-item" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-plus-circle"></i> Adicionar Lote
                    </button>

                    <div>
                        <a href="{{ route('consumos.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-success">Salvar Consumo</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Template oculto --}}
    <template id="item-template">
        <tr>
            <td>
                <select name="estoques[]" class="form-select" required>
                    <option value="">Selecione um lote</option>
                    @foreach ($estoques as $e)
                        <option value="{{ $e->id }}">
                            {{ $e->produto->nome }} — Lote {{ $e->id }}
                            — Val: {{ date('d/m/Y', strtotime($e->validade)) }}
                            — Saldo: {{ $e->quantidade_saldo }}
                        </option>
                    @endforeach
                </select>
            </td>

            <td>
                <input type="number" name="quantidades[]" class="form-control" min="1" required>
            </td>

            <td class="text-center">
                <button type="button" class="btn btn-danger btn-sm remove-item">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        </tr>
    </template>

    {{-- Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const addButton = document.getElementById('add-item');
            const tableBody = document.getElementById('itens-tabela');
            const template = document.getElementById('item-template').content;

            // ➕ Adicionar linha
            addButton.addEventListener('click', () => {
                const clone = document.importNode(template, true);
                tableBody.appendChild(clone);
            });

            // 🗑️ Remover linha
            tableBody.addEventListener('click', (event) => {
                if (event.target.closest('.remove-item')) {
                    event.target.closest('tr').remove();
                }
            });

        });
    </script>

@endsection
