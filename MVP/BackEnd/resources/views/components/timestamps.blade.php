@props(['createdAt' => null, 'updatedAt' => null])

<div class="row">
    <div class="col-md-6 mb-3">
        <p class="mb-1 text-muted small">Criado em</p>
        <p class="fw-semibold">
            {{ $createdAt ? \Carbon\Carbon::parse($createdAt)->format('d/m/Y H:i') : '—' }}
        </p>
    </div>
    <div class="col-md-6 mb-3">
        <p class="mb-1 text-muted small">Última atualização</p>
        <p class="fw-semibold">
            {{ $updatedAt ? \Carbon\Carbon::parse($updatedAt)->format('d/m/Y H:i') : '—' }}
        </p>
    </div>
</div>
