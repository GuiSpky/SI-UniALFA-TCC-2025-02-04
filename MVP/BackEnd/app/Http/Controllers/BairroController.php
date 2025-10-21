<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\BairroResource;
use App\Models\Bairro;
use App\Models\Cidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BairroController extends Controller
{

    public function index()
    {
        $bairros = Bairro::all();
        $cidades = Cidade::all();

        return view('bairros.index', [
            'bairros' => $bairros,
            'cidades' => $cidades
        ]);
    }

    public function create()
    {

        $cidades = Cidade::all();

        return view('bairros.create', [
            'cidades' => $cidades
        ]);
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:100|unique:bairros,nome',
            'id_cidade' => 'required|integer',
        ], [
            'nome.unique' => 'Bairro já está cadastrado.',
            'id_cidade.unique' => 'Informe a cidade.',
        ]);

        Bairro::create($dados);
        return redirect('/bairros')->with('sucesso', 'Cadastro realizado com sucesso!');
    }

    public function show(string $id)
    {
        $bairro = Bairro::findOrFail($id); // Encontra o recurso ou lança um erro 404
        $cidade = Cidade::all();

        return view('bairros.show', [
            'bairro' => $bairro,
            'cidades' => $cidade
        ]);
    }

    public function edit(string $id)
    {
        $cidades = Cidade::all();
        $bairro = Bairro::find($id);
        return view('bairros.edit', [
            'bairro' => $bairro,
            'cidades' => $cidades
        ]);
    }

    public function update(Request $request, string $id)
    {
        $bairro = Bairro::find($id);

        $bairro->update([
            'nome' => $request->nome,
            'id_cidade' => $request->id_cidade,
        ]);

        return redirect('/bairros');
    }

    public function destroy(string $id)
    {
        $bairro = Bairro::findOrFail($id); // Encontra o recurso ou lança um erro 404

        // Exclui o ambiente
        $bairro->delete();

        // Retorna apenas uma mensagem de sucesso
        return redirect('/bairros');
    }

    public function getBairrosByCidade($id)
    {
        $dados = Bairro::join('cidades', 'bairros.id_cidade', '=', 'cidades.id')
            ->where('bairros.id_cidade', $id)
            ->select('bairros.*', 'cidades.nome as nome_cidade')
            ->get();

        return BairroResource::collection($dados);
    }

    public function count()
    {
        return response()->json(['total' => Bairro::count()]);
    }
}
