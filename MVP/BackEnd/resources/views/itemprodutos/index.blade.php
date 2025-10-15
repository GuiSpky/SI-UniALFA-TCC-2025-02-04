@extends('app')
@section('tittle', 'Estoque')

@section('content')
    <h1>Estoque</h1>
    <a href="{{ route('produtos.create') }}" class="btn btn-success">Novo Produto</a>
    <table class="table">
        <thead>
            <td>ID</td>
            <td>Nome</td>
            <td>Grupo</td>
            <td>Quantidade</td>
            <td>Validade</td>
            <td>Entrada</td>
            <td>Local</td>
            <td>Opções</td>
        </thead>
        <tbody>
            @foreach ($produtos as $produto)
                <tr>
                    <td>{{$produto->id}}</td>
                    <td><a href="{{route('produtos.show', $produto)}}">
                        {{ $item->where('id', $produto->id_produto)->pluck('nome')->first()}}</a></td>
                    <td>{{ $item->where('id', $produto->id_produto)->pluck('grupo')->first()}}</td>
                    <td>{{$produto->Quantidade}}</td>
                    <td>{{$produto->Validade}}</td>
                    <td>{{$produto->Entrada}}</td>
                    <td>{{$produto->Local}}</td>
                    <td>{{ $escola->where('id', $produto->id_produto)->pluck('nome')->first()}}</td>
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
