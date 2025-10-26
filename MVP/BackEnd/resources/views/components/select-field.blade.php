<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <select
        class="form-select"
        id="{{ $name }}"
        name="{{ $name }}"
        {{ $required ? 'required' : '' }}
    >
        <option value="" disabled {{ $selected ? '' : 'selected' }}>Selecione {{ strtolower($label) }}</option>
        @foreach ($options as $value => $text)
            <option value="{{ $value }}" {{ old($name, $selected) == $value ? 'selected' : '' }}>
                {{ $text }}
            </option>
        @endforeach
    </select>
</div>
