<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CidadeResource;
use App\Models\Cidade;
use Illuminate\Http\Request;

class CidadeController extends Controller
{
    public function index()
    {
        $dados = Cidade::all();
        return view('cidades.index', [
            'cidades' => $dados
        ]);
    }

    public function create()
    {
        return view('cidades.create');
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
        'codIbge' => 'required|Integer',
        'nome' => 'required|string|max:100',
        'uf' => 'required|string|max:2',
    ]);

        Cidade::create($dados);
        return redirect('/cidades');
    }

    public function show(string $id)
    {
        $cidade = Cidade::findOrFail($id); // Encontra o recurso ou lança um erro 404

        return view('cidades.show', ['cidade'=> $cidade]);

    }

    public function edit(string $id)
    {
        $cidade = Cidade::find($id);
        return view('cidades.edit',[
            'cidade' => $cidade
        ]);
    }

    public function update(Request $request, string $id)
    {
        $cidade = Cidade::find($id);

        $cidade-> update([
            'codIbge' => $request->codIbge,
            'nome' => $request->nome,
            'uf' => $request->uf
        ]);

        return redirect('/cidades');
    }

    public function destroy(string $id)
    {
        $cidade = Cidade::findOrFail($id); // Encontra o recurso ou lança um erro 404

        // Exclui o ambiente
        $cidade->delete();

        // Retorna apenas uma mensagem de sucesso
        return redirect('/cidades');

    }

    public function count()
    {
        return response()->json(['total' => Cidade::count()]);
    }
}
