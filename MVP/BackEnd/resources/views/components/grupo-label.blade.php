@props(['value'])

@php
    $grupos = [
        1 => 'Proteinas',
        2 => 'Carboidratos',
        3 => 'Oleogenosos',
        4 => 'Fibras',
    ];
@endphp

<span class="badge bg-success">
    {{ $grupos[$value] ?? 'Não informado' }}
</span>
