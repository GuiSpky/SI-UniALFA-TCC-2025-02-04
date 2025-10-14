@extends('app')
@section('tittle', 'Editar Usuário')
@section('content')

<h1>Editar Usuário</h1>
    <form action="{{ route('usuarios.update', $usuario) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control"
            placeholder="Digite o nome" value="{{$usuario->nome}}">
        </div>
        <div class="mb-3">
            <label for="nome" class="form-label">Email</label>
            <input type="text" name="email" id="email" class="form-control"
            placeholder="Digite o email" value="{{$usuario->email}}">
        </div>
        <div class="mb-3">
            <label for="nome" class="form-label">Telefone</label>
            <input type="text" name="telefone" id="telefone" class="form-control"
            placeholder="Digite o telefone" value="{{$usuario->telefone}}">
        </div>
        <div class="form-group mb-3">
            <label>Selecione o Cargo</label>
            <select name="cargo" class="form-control" required>
                <option value="">-- Escolha um cargo --</option>
                    <option value="0">Gerente</option>
                    <option value="1">Cozinheiro Cheff</option>
                    <option value="2">Cozinheiro</option>
                    <option value="3">Nutricionista</option>
            </select>
        </div>
        <div class="form-group mb-3">
            <label>Selecione a Escola</label>
            <select name="id_cidade" class="form-control" required>
                <option value="">-- Escolha uma escola --</option>
                @foreach ($escolas as $escola)
                    <option value="{{ $escola->id }}">{{ $escola->nome }}</option>
                @endforeach
            </select>
        </div>


        <button class="btn btn-success" type="submit">Enviar</button>
        <a class="btn btn-danger" href="{{route('usuarios.index')}}">Cancelar</a>
    </form>
@endsection
