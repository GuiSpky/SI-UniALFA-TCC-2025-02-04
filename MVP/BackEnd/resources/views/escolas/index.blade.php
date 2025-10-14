@extends('app')
@section('tittle', 'Lista de Escolas')

@section('content')
    <h1>Lista de Escolas</h1>
    <a href="{{ route('escolas.create') }}" class="btn btn-success">Nova Escola</a>
    <table class="table">
        <thead>
            <td>Id</td>
            <td>Nome</td>
            <td>Cidade</td>
            <td>Bairro</td>
            <td>Opções</td>
        </thead>
        <tbody>
            @foreach ($escolas as $escola)
                <tr>
                    <td>{{$escola->id}}</td>
                    <td><a href="{{route('escolas.show', $escola)}}">{{$escola->nome}}</a></td>
                    <td>{{ $cidades->where('id', $escola->id_cidade)->pluck('nome')->first()}}</td>
                    <td>{{ $bairros->where('id', $escola->id_bairro)->pluck('nome')->first()}}</td>
                    <td class="btn-group" role="group"><a href="{{route('escolas.edit', $escola->id)}}" class="btn btn-warning">Update</a>
                    <form action="{{route('escolas.destroy', $escola)}}" method="POST">
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
