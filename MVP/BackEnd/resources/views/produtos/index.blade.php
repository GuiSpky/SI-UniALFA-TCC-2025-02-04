@extends('app')
@section('title', 'Lista de Produtos')

@section('content')
    <h1>Lista de Escolas</h1>
    <a href="{{ route('produtos.create') }}" class="btn btn-success">Novo Produto</a>
    <table class="table">
        <thead>
            <td>Id</td>
            <td>Nome</td>
            <td>Grupo</td>
        </thead>
        <tbody>
            @foreach ($produtos as $produto)
                <tr>
                    <td>{{$produto->id}}</td>
                    <td><a href="{{route('produto.show', $produto)}}">{{$produto->nome}}</a></td>
                    <td>{{$produto->grupo}}</td>
                    <td class="btn-group" role="group"><a href="{{route('produtos.edit', $produto->id)}}" class="btn btn-warning">Update</a>
                    <form action="{{route('produtos.destroy', $produto)}}" method="POST">
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

