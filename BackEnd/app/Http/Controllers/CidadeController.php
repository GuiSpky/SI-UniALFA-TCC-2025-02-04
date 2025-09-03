<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use Illuminate\Http\Request;

class CidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Buscar os clientes no Banco de dados;
        $cidades = Cidade::get(); // :: significa que o método utilizado é estatico

        // Mostrar um FrontEnd listando os clientes.
        return view('cidades.index', [
            'cidades' => $cidades
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cidades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dados = $request->except('_token');
        Cidade::create($dados);
        return redirect('/cidades');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cidades = Cidade::find($id);

         return view('cidade.show', ['cidade'=> $cidades]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cidade = Cidade::find($id);
        return view('cidades.edit',[
            'cidades' => $cidade
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cidades = Cidade::find($id);

        $cidades-> update([
            'codIbge' => $request->codIbge,
            'nome' => $request->nome,
            'uf' => $request->uf
        ]);

        return redirect('/cidades');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cidades = Cidade::find($id);
        $cidades->delete();
        return redirect('/cidades');
    }
}
