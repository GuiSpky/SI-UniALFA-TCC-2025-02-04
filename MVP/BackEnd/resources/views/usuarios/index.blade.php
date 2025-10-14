@extends('app')
@section('tittle', 'Lista de Usuários')

@section('content')
    <h1>Lista de Usuários</h1>
    <a href="{{ route('usuarios.create') }}" class="btn btn-success">Novo usuário</a>
    <table class="table">
        <thead>
            <td>Id</td>
            <td>Nome</td>
            <td>Email</td>
            <td>Telefone</td>
            <td>Cargo</td>
            <td>Escola</td>
            <td>Opções</td>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{$usuario->id}}</td>
                    <td><a href="{{route('usuario.show', $usuario)}}">{{$usuario->nome}}</a></td>
                    <td>{{$usuario->email}}</td>
                    <td>{{$usuario->telefone}}</td>
                    <td>{{$usuario->cargo}}</td>
                    <td>{{ $escola->where('id', $usuario->id_escola)->pluck('nome')->first()}}</td>
                    <td class="btn-group" role="group"><a href="{{route('usuarios.edit', $usuario)}}" class="btn btn-warning">Update</a>
                    <form action="{{route('usuarios.destroy', $usuario)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger"
                        type="submit"
                        onclick="return confirm('Deseja realmente apagar?')">
                            Apagar
                        </button>
                    </form></td>

                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
