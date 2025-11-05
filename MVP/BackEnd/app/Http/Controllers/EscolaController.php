<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\EscolaResource;
use App\Models\Bairro;
use App\Models\Cidade;
use App\Models\Escola;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class EscolaController extends Controller
{
    public function index()
    {
        $escolas = Escola::all();
        $cidades = Cidade::all();
        $bairros = Bairro::all();

        return view('escolas.index', [
            'escolas' => $escolas,
            'bairros' => $bairros,
            'cidades' => $cidades
        ]);
    }

    public function create()
    {
        $cidades = Cidade::all();
        $bairros = Bairro::all();

        return view('escolas.create', [
            'cidades' => $cidades,
            'bairros' => $bairros
        ]);
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:255|unique:escolas,nome',
            'id_cidade' => 'required|integer',
            'id_bairro' => 'required|integer',
        ], [
            'nome.required' => 'Nome deve ser informado.',
            'nome.unique' => 'Escola já cadastrada.',

        ]);

        try {
            Escola::create($dados);
            return redirect('/escolas')->with('sucesso', 'Escola cadastrada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('erro', 'Falha ao cadastrar escola. Tente novamente.');
        }
    }

    public function edit(string $id)
    {
        $escola = Escola::find($id);
        $cidades = Cidade::all();
        $bairros = Bairro::all();

        // return($escola);
        return view('escolas.edit', [
            'escola' => $escola,
            'cidades' => $cidades,
            'bairros' => $bairros
        ]);
    }

    public function show(string $id)
    {
        $escola = Escola::findOrFail($id); // Encontra o recurso ou lança um erro 404
        $cidade = Cidade::all();
        $bairro = Bairro::all();

        return view('escolas.show', [
            'escola' => $escola,
            'cidades' => $cidade,
            'bairro' => $bairro
        ]);
    }

    public function update(Request $request, string $id)
    {
        $escola = Escola::findOrFail($id);

        $dados = $request->validate([
            'nome' => ['required', 'string', 'max:255', Rule::unique('escolas')->ignore($id)],
            'id_cidade' => 'required|integer',
            'id_bairro' => 'required|integer',
        ], [
            'nome.required' => 'Nome deve ser informado.',
            'nome.unique' => 'Escola já cadastrada.',

        ]);

        try {
            $escola->update($dados);
            return redirect('/escolas')->with('sucesso', 'Escola atualizada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('erro', 'Falha ao atualizar Escola. Tente novamente.');
        }
    }

    public function destroy(string $id)
    {

        try {
            $escola = Escola::findOrFail($id);
            $escola->delete();
            return redirect('/escolas')->with('sucesso', 'Escola excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect('/escolas')->with('erro', 'Erro ao excluir Escola.');
        }
    }

    public function getEscolaBairro()
    {
        $escolas = DB::table('escolas')
            ->join('bairros', 'escolas.id_bairro', '=', 'bairros.id')
            ->join('cidades', 'escolas.id_cidade', '=', 'cidades.id')
            ->select(
                'escolas.id',
                'escolas.nome as nome',
                'bairros.nome as bairro',
                'cidades.nome as cidade'
            )
            ->get();

        return response()->json([
            'data' => $escolas
        ]);
    }

    public function count()
    {
        return response()->json(['total' => Escola::count()]);
    }
}
