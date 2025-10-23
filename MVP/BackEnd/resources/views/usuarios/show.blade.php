@extends('layouts.app')
@section('title', 'Detalhe do Usuário')
@section('content')
<div class="container-fluid">
    <div class="mb-4 fade-in-up">
        <div class="d-flex align-items-center mb-3">
            <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary btn-sm me-3">
                <i class="bi bi-arrow-left me-2"></i>Voltar
            </a>
            <div>
                <h1 class="h2 fw-bold mb-1"><i class="bi bi-person-fill me-2"></i>Detalhes do Usuário</h1>
                <p class="text-muted mb-0">Informações detalhadas do usuário</p>
            </div>
        </div>
    </div>
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-bottom-0">
            <h5 class="mb-0">Detalhes do Usuário: {{$usuario->nome}}</h5>
        </div>
        <div class="card-body">
            <p><strong>ID: </strong>{{$usuario->id}}</p>
            <p><strong>Nome: </strong>{{$usuario->nome}}</p>
            <p><strong>Email: </strong>{{ $usuario->email}}</p>
            <p><strong>Telefone: </strong>{{ $usuario->telefone}}</p>
            <p><strong>Cargo: </strong>{{ $usuario->cargo}}</p>
            <p><strong>Escola: </strong>{{ $escolas->where('id', $usuario->id_escola)->pluck('nome')->first()}}</p>
            <br>
            <a class="btn btn-outline-secondary" href="{{ route('usuarios.index') }}"><i class="bi bi-arrow-left me-2"></i>Voltar</a>
        </div>
    </div>
</div>
@endsection