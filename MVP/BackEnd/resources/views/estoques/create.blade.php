@extends('layouts.app')

@section('title', 'Nova Entrada')

@section('content')
<div class="container-fluid">

    <div class="fade-in-up mb-4">
        <div class="d-flex align-items-center mb-3">
            <div>
                <h1 class="h2 fw-bold mb-1">
                    <i class="bi bi-archive me-2"></i>Nova Entrada
                </h1>
                <p class="text-muted mb-0">Cadastre uma nova entrada de produto no estoque</p>
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

        <form action="{{ route('estoques.store') }}" method="POST">
            @csrf

            {{-- Armazém --}}
            @if (Auth::user()->cargo == 1)
                <div class="mb-3">
                    <label class="form-label">Armazém</label>
                    <select name="escola_id" class="form-select" required>
                        @foreach ($escolas as $e)
                            <option value="{{ $e->id }}">{{ $e->nome }}</option>
                        @endforeach
                    </select>
                </div>
            @else
                <input type="hidden" name="escola_id" value="{{ Auth::user()->escola_id }}">
            @endif

            <table class="table table-bordered align-middle">
                <thead>
                    <tr class="text-uppercase small fw-bold">
                        <th>Produto</th>
                        <th style="width: 150px;">Quantidade</th>
                        <th style="width: 150px;">Validade</th>
                        <th style="width: 50px;">Ações</th>
                    </tr>
                </thead>

                <tbody id="itens-tabela">

                    {{-- Primeira linha --}}
                    <tr>
                        <td>
                            <select name="produto_id[]" class="form-select" required>
                                <option value="">Selecione o produto</option>
                                @foreach ($produtos as $p)
                                    <option value="{{ $p->id }}">{{ $p->nome }} - {{ $p->medida }}</option>
                                @endforeach
                            </select>
                        </td>

                        <td>
                            <input type="number" name="quantidade_entrada[]" class="form-control" min="1" required>
                        </td>

                        <td>
                            <input type="date" name="validade[]" class="form-control" required>
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
                    <i class="bi bi-plus-circle"></i> Adicionar Produto
                </button>

                <div>
                    <a href="{{ route('estoques.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-success">Salvar Entrada</button>
                </div>

            </div>

        </form>
    </div>
</div>

{{-- Template oculto --}}
<template id="item-template">
    <tr>
        <td>
            <select name="produto_id[]" class="form-select" required>
                <option value="">Selecione o produto</option>
                @foreach ($produtos as $p)
                    <option value="{{ $p->id }}">{{ $p->nome }} - {{ $p->medida }}</option>
                @endforeach
            </select>
        </td>

        <td>
            <input type="number" name="quantidade_entrada[]" class="form-control" min="1" required>
        </td>

        <td>
            <input type="date" name="validade[]" class="form-control" required>
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
