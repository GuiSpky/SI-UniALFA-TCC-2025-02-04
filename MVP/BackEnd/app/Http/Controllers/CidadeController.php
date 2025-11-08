<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CidadeResource;
use App\Models\Cidade;
use Illuminate\Http\Request;

class CidadeController extends Controller
{

    private $ufs = [
        'AC' => 'Acre',
        'AL' => 'Alagoas',
        'AP' => 'Amapá',
        'AM' => 'Amazonas',
        'BA' => 'Bahia',
        'CE' => 'Ceará',
        'DF' => 'Distrito Federal',
        'ES' => 'Espírito Santo',
        'GO' => 'Goiás',
        'MA' => 'Maranhão',
        'MT' => 'Mato Grosso',
        'MS' => 'Mato Grosso do Sul',
        'MG' => 'Minas Gerais',
        'PA' => 'Pará',
        'PB' => 'Paraíba',
        'PR' => 'Paraná',
        'PE' => 'Pernambuco',
        'PI' => 'Piauí',
        'RJ' => 'Rio de Janeiro',
        'RN' => 'Rio Grande do Norte',
        'RS' => 'Rio Grande do Sul',
        'RO' => 'Rondônia',
        'RR' => 'Roraima',
        'SC' => 'Santa Catarina',
        'SP' => 'São Paulo',
        'SE' => 'Sergipe',
        'TO' => 'Tocantins',
    ];

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $cidades = Cidade::paginate($perPage);
        return view('cidades.index', compact('perPage','cidades'));
    }

    public function create()
    {
        return view('cidades.create', [
            'ufs' => $this->ufs
        ]);
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'codIbge' => 'required|Integer',
            'nome' => 'required|string',
            'uf' => 'required|string|max:2',
        ], [
            'codIbge.required' => "Código IBGE deve ser inserido",
            'nome.required' => "Nome deve ser informado",
            'uf.required' => "UF não informado",
            'nome.unique' => "Cidade já cadastrada",
        ]);

        try {
            Cidade::create($dados);
            return redirect('/cidades')->with('sucesso', 'Cidade cadastrada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('erro', 'Falha ao cadastrar cidade. Tente novamente.');
        }
    }

    public function show(string $id)
    {
        $cidade = Cidade::findOrFail($id); // Encontra o recurso ou lança um erro 404

        return view('cidades.show', [
        'cidade' => $cidade,
        'ufs' => $this->ufs, // envia a lista de UFs
    ]);
    }

    public function edit($id)
    {
        $cidade = Cidade::findOrFail($id);
        return view('cidades.edit', [
            'cidade' => $cidade,
            'ufs' => $this->ufs,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $cidade = Cidade::findOrFail($id);

        $dados = $request->validate([
            'codIbge' => 'required|integer',
            'nome' => 'required|string',
            'uf' => 'required|string|max:2',
        ]);

        try {
            $cidade->update($dados);
            return redirect('/cidades')->with('sucesso', 'Cidade atualizada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('erro', 'Falha ao atualizar cidade. Tente novamente.');
        }
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
