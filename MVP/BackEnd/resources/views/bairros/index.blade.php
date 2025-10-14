@extends('app')
@section('tittle', 'Lista de Bairros')

@section('content')
    <h1>Lista de Bairros</h1>
    <a href="{{ route('bairros.create') }}" class="btn btn-success">Novo Bairro</a>
    <table class="table">
        <thead>
            <td>Id</td>
            <td>Nome</td>
            <td>Cidade</td>
            <td>Opções</td>
        </thead>
        <tbody>
            @foreach ($bairros as $bairro)
                <tr>
                    <td>{{$bairro->id}}</td>
                    <td><a href="{{route('bairros.show', $bairro)}}">{{$bairro->nome}}</a></td>
                    <td>{{ $cidades->where('id', $bairro->id_cidade)->pluck('nome')->first()}}</td>
                    <td class="btn-group" role="group"><a href="{{route('bairros.edit', $bairro->id)}}" class="btn btn-warning">Update</a>
                    <form action="{{route('bairros.destroy', $bairro)}}" method="POST">
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
