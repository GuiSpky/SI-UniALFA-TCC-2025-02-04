@extends('layouts.app')

@section('title', 'Editar Usuário')

@section('content')

    <div class="container-fluid py-4">
        <div class="mb-4 fade-in-up">
            <div class="d-flex align-items-center mb-3">
                <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary btn-sm me-3">
                    <i class="bi bi-arrow-left me-2"></i>Voltar
                </a>
                <div>
                    <h1 class="h2 fw-bold mb-1"><i class="bi bi-pencil-square me-2"></i>Editar Usuário</h1>
                    <p class="text-muted mb-0">Atualize os dados do usuário</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card fade-in-up border-2 shadow-sm rounded-3">
                    <div class="card-body p-4 p-md-5">

                        <form action="{{ route('usuarios.update', $user->id) }}" method="POST">
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
                                <label for="name" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', $user->name) }}" required>
                            </div>

                            {{-- Email --}}
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', $user->email) }}" required>
                            </div>

                            {{-- Telefone --}}
                            <div class="mb-3">
                                <label for="telefone" class="form-label">Telefone</label>
                                <input type="tel" class="form-control" id="telefone" name="telefone"
                                    value="{{ old('telefone', $user->telefone) }}" required>
                            </div>

                            {{-- Cargo --}}
                            <div class="mb-3">
                                <x-select-field name="cargo" label="Cargo" :options="$cargos" :selected="$usuario->cargo ?? old('cargo')" />
                            </div>

                            {{-- Escola --}}
                            <div class="mb-3">
                                <label for="id_escola" class="form-label">Escola</label>
                                <select name="id_escola" id="id_escola" class="form-select" required>
                                    <option value="">Selecione uma Escola</option>
                                    @foreach ($escolas as $escola)
                                        <option value="{{ $escola->id }}"
                                            {{ old('id_escola', $user->id_escola) == $escola->id ? 'selected' : '' }}>
                                            {{ $escola->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Botões --}}
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle me-2"></i>Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-2"></i>Atualizar Usuário
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
