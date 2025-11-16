<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class RelatorioExport implements FromArray
{
    protected $dados;

    public function __construct($dados)
    {
        $this->dados = $dados;
    }

    public function array(): array
    {
        $cabecalho = array_keys((array)$this->dados['dados']->first() ?? []);

        $linhas = $this->dados['dados']->map(function ($linha) {
            return (array)$linha;
        })->toArray();

        return array_merge([$cabecalho], $linhas);
    }
}
