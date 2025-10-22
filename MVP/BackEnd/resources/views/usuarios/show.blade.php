@extends('layouts.app')
@section('title', 'Detalhe do Usuário')
@section('content')
    <div class="card">
        <div class="card-header">
            Detalhes do Usuário {{$usuario->nome}}
        </div>
        <div class="card-body">
            <p><strong>ID: </strong>{{$usuario->id}}</p>
            <p><strong>Nome: </strong>{{$usuario->nome}}</p>
            <p><strong>Email: </strong>{{ $usuario->email}}</p>
            <p><strong>Telefone: </strong>{{ $usuario->telefone}}</p>
            <p><strong>Cargo: </strong>{{ $usuario->cargo}}</p>
            <p><strong>Escola: </strong>{{ $escolas->where('id', $usuario->id_escola)->pluck('nome')->first()}}</p>
            <br>
            <a class="btn btn-success" href="{{ route('usuarios.index') }}">Voltar</a>
        </div>
    </div>
</div>

<style>
    a:hover {
        text-decoration: underline;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
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

