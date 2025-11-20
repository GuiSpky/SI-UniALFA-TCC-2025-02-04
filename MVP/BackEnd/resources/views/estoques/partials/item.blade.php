<tr class="item-linha">
    <td>
        <select class="form-select" name="produto_id[]" required>
            <option value="">Selecione o produto</option>
            @foreach ($produtos as $produto)
                <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
            @endforeach
        </select>
    </td>

    <td>
        <input type="number" class="form-control" name="quantidade_entrada[]" required>
    </td>

    <td>
        <input type="date" class="form-control" name="validade[]" required>
    </td>

    <td class="text-center">
        <button type="button" class="btn btn-danger btn-sm remove-item">
            <i class="bi bi-trash"></i>
        </button>
    </td>
</tr>
