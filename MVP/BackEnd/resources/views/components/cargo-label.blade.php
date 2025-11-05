@props(['value'])

@php
    $cargos = [
        1 => ['nome' => 'Gerente', 'cor' => 'bg-danger'],
        2 => ['nome' => 'Cozinheiro Cheff', 'cor' => 'bg-warning text-dark'],
        3 => ['nome' => 'Cozinheiro', 'cor' => 'bg-info text-dark'],
        4 => ['nome' => 'Nutricionista', 'cor' => 'bg-success'],
    ];

    $cargo = $cargos[$value] ?? ['nome' => 'Não informado', 'cor' => 'bg-light text-dark'];
@endphp

<span class="badge {{ $cargo['cor'] }}">
    {{ $cargo['nome'] }}
</span>
