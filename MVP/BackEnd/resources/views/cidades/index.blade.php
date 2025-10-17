@extends('app')
@section('tittle', 'Lista de Cidades')

@section('content')
    <h1>Lista de Cidades</h1>
    <a href="{{ route('cidades.create') }}" class="btn btn-success">Nova Cidade</a>
    <table class="table">
        <thead>
            <td>Cod. Ibge</td>
            <td>Nome</td>
            <td>UF</td>
            <td>Opções</td>
        </thead>
        <tbody>
            @foreach ($cidades as $cidade)
                <tr>
                    <td>{{$cidade->codIbge}}</td>
                    <td><a href="{{route('cidade.show', $cidade)}}">{{$cidade->nome}}</a></td>
                    <td>{{$cidade->uf}}</td>
                    <td class="btn-group" role="group"><a href="{{route('cidades.edit', $cidade->id)}}" class="btn btn-warning">Update</a>
                    <form action="{{route('cidades.destroy', $cidade)}}" method="POST">
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
