@extends('app')
@section('tittle', 'Detalhe do Usuário')
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
@endsection
