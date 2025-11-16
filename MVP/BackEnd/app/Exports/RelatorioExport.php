<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RelatorioExport implements FromArray, WithHeadings
{
    protected $dadosRelatorio;

    public function __construct(array $dadosRelatorio)
    {
        $this->dadosRelatorio = $dadosRelatorio;
    }

    /**
    * @return array
    */
    public function array(): array
    {
        // A função gerarDados retorna um array com a chave 'dados' contendo a Collection
        // e a chave 'titulo' com o título.
        // Para exportar, precisamos apenas dos dados do relatório.
        $dados = $this->dadosRelatorio['dados'];

        // Converte a Collection de objetos para um array de arrays
        return $dados->map(function ($item) {
            return (array) $item;
        })->toArray();
    }

    /**
    * @return array
    */
    public function headings(): array
    {
        // Pega o primeiro item da Collection para extrair as chaves (cabeçalhos)
        $dados = $this->dadosRelatorio['dados'];

        if ($dados->isEmpty()) {
            return [];
        }

        // Pega as chaves do primeiro objeto/array como cabeçalhos
        return array_keys((array) $dados->first());
    }
}
