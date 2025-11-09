<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\BairroResource;
use App\Models\Bairro;
use App\Models\Cidade;
use Illuminate\Http\Request;

class BairroController extends Controller
{

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $bairros = Bairro::paginate($perPage);
        $cidades = Cidade::all();

        return view('bairros.index', compact('perPage', 'bairros', 'cidades'));
    }

    public function create()
    {

        $cidades = Cidade::all();

        return view('bairros.create', compact('cidades'));
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:100|unique:bairros,nome',
            'id_cidade' => 'required|integer|exists:cidades,id',
        ], [
            'nome.unique' => 'Bairro já está cadastrado.',
            'id_cidade.unique' => 'Informe a cidade.',
        ]);

        try {
            Bairro::create($dados);
            return redirect('/bairros')->with('sucesso', 'Bairro cadastrado com sucesso!');
        } catch (\Exception $e) {
            // Pode ser útil logar o erro: \Log::error('Erro ao cadastrar bairro: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('erro', 'Falha ao cadastrar o bairro. Tente novamente.');
        }
    }

    public function show(string $id)
    {
        $bairro = Bairro::findOrFail($id); // Encontra o recurso ou lança um erro 404
        $cidades = Cidade::all();

        return view('bairros.show', compact('bairro', 'cidades'));
    }

    public function edit(string $id)
    {
        $cidades = Cidade::all();
        $bairro = Bairro::findOrFail($id);
        return view('bairros.edit', compact('bairro', 'cidades'));
    }

    public function update(Request $request, string $id)
    {
        $bairro = Bairro::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'required|string|max:100',
            'id_cidade' => 'required|integer|exists:cidades,id',
        ]);

        $validated['id_cidade'] = (int) $validated['id_cidade'];

        $bairro->update($validated);

        return redirect()->route('bairros.index')->with('sucesso', 'Bairro atualizado com sucesso!');
    }

    public function destroy(string $id)
    {
        try {
            $bairro = Bairro::findOrFail($id);
            $bairro->delete();
            return redirect('/bairros')->with('sucesso', 'Bairro excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect('/bairros')->with('erro', 'Erro ao excluir o bairro.');
        }
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
