@extends('layouts.app')

@section('title', 'Editar Pedido')

@section('content')
<div class="container-fluid">
    <div class="fade-in-up mb-4">
        <div class="d-flex align-items-center mb-3">
            <div>
                <h1 class="h2 fw-bold mb-1"><i class="bi bi-pencil-square me-2"></i>Editar Pedido #{{ $pedido->id }}</h1>
                <p class="text-muted mb-0">Modifique os produtos e quantidades do pedido</p>
            </div>
        </div>
    </div>

    <div class="card border-2 shadow-sm rounded-3 p-4">
        <form action="{{ route('pedidos.update', $pedido) }}" method="POST">
            @csrf
            @method('PUT')

            <table class="table table-bordered align-middle">
                <thead>
                    <tr class="text-uppercase small fw-bold">
                        <th>Produto</th>
                        <th style="width: 150px;">Quantidade</th>
                        <th style="width: 50px;">Ações</th>
                    </tr>
                </thead>
                <tbody id="itens-pedido">
                    @foreach ($pedido->itens as $item)
                        <tr>
                            <td>
                                <select name="produtos[]" class="form-select" required>
                                    <option value="">Selecione um produto</option>
                                    @foreach ($produtos as $produto)
                                        <option value="{{ $produto->id }}" {{ $item->produto_id == $produto->id ? 'selected' : '' }}>
                                            {{ $produto->nome }} ({{ $produtos->where('id', $produto->id)->pluck('medida')->first() ?? 'N/A' }})
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" name="quantidades[]" class="form-control" min="1" value="{{ $item->quantidade }}" required>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger btn-sm remove-item">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <button type="button" id="add-item" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-plus-circle"></i> Adicionar Produto
                </button>
                <div>
                    <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-success">Salvar Alterações</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Template oculto para novos itens --}}
<template id="item-template">
    <tr>
        <td>
            <select name="produtos[]" class="form-select" required>
                <option value="">Selecione um produto</option>
                @foreach ($produtos as $produto)
                    <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                @endforeach
            </select>
        </td>
        <td>
            <input type="number" name="quantidades[]" class="form-control" min="1" value="1" required>
        </td>
        <td class="text-center">
            <button type="button" class="btn btn-danger btn-sm remove-item">
                <i class="bi bi-trash"></i>
            </button>
        </td>
    </tr>
</template>

{{-- Script para manipular linhas dinamicamente --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const addButton = document.getElementById('add-item');
    const tableBody = document.getElementById('itens-pedido');
    const template = document.getElementById('item-template').content;

    addButton.addEventListener('click', () => {
        const clone = document.importNode(template, true);
        tableBody.appendChild(clone);
    });

    tableBody.addEventListener('click', (event) => {
        if (event.target.closest('.remove-item')) {
            event.target.closest('tr').remove();
        }
    });
});
</script>
@endsection
