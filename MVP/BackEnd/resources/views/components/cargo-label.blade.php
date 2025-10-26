@props(['value'])

@php
    $cargos = [
        1 => 'Gerente',
        2 => 'Cozinheiro Cheff',
        3 => 'Cozinheiro',
        4 => 'Nutricionista',
    ];
@endphp

<span class="badge bg-success">
    {{ $cargos[$value] ?? 'Não informado' }}
</span>
