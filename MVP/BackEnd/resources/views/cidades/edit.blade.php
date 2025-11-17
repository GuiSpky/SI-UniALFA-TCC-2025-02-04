@extends('layouts.app')

@section('title', 'Editar Cidade')

@section('content')

    <div class="container-fluid py-4">
        <div class="mb-4 fade-in-up">
            <div class="d-flex align-items-center mb-3">
                <a href="{{ route('cidades.index') }}" class="btn btn-outline-secondary btn-sm me-3">
                    <i class="bi bi-arrow-left me-2"></i>Voltar
                </a>
                <div>
                    <h1 class="h2 fw-bold mb-1"><i class="bi bi-pencil-square me-2"></i>Editar Cidade</h1>
                    <p class="text-muted mb-0">Atualize os dados da cidade</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card fade-in-up border-2 shadow-sm rounded-3">
                    <div class="card-body p-4 p-md-5">

                        <form action="{{ route('cidades.update', $cidade->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- Mensagens de erro --}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            {{-- Nome --}}
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome"
                                    value="{{ old('nome', $cidade->nome) }}" required>
                            </div>


                            {{-- UF --}}
                            <div class="mb-3">
                                <x-select-field name="uf" label="UF" :options="$ufs" :selected="$cidade->uf ?? old('uf')" />
                            </div>


                            {{-- Botões --}}
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('cidades.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle me-2"></i>Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-2"></i>Atualizar Cidade
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
