@props(['value'])

@php
    $grupos = [
        1 => ['nome' => 'Proteinas', 'cor' => 'bg-danger-subtle text-dark'],
        2 => ['nome' => 'Carboidratos', 'cor' => 'bg-info-subtle text-dark'],
        3 => ['nome' => 'Oleogenosos', 'cor' => 'bg-warning-subtle text-dark'],
        4 => ['nome' => 'Fibras', 'cor' => 'bg-success-subtle text-dark'],
    ];

    $grupo = $grupos[$value] ?? ['nome' => 'Não informado', 'cor' => 'bg-light text-dark'];
@endphp

<span class="badge {{ $grupo['cor'] }}">
    {{ $grupo['nome'] }}
</span>
