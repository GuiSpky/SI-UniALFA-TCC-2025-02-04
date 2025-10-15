@extends('app')
@section('tittle', 'Lista de Cardápios')

@section('content')
    <h1>Lista de Cardápios</h1>
    <a href="{{ route('cardapios.create') }}" class="btn btn-success">Novo Cardápio</a>
    <table class="table">
        <thead>
            <td>Id</td>
            <td>Nome</td>
            <td>Item</td>
            <td>Data</td>
            <td>Opções</td>
        </thead>
        <tbody>
            @foreach ($cardapios as $cardapio)
                <tr>
                    <td>{{$cardapio->id}}</td>
                    <td><a href="{{route('cardapio.show', $cardapio)}}">{{$cardapio->nome}}</a></td>
                    <td>{{$cardapio->item}}</td>
                    <td>{{$cardapio->data}}</td>
                    <td class="btn-group" role="group"><a href="{{route('cardapios.edit', $cardapio)}}" class="btn btn-warning">Update</a>
                    <form action="{{route('cardapios.destroy', $cardapio)}}" method="POST">
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
