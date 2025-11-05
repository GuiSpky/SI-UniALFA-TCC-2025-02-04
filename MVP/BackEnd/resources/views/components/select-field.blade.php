@props(['name', 'label', 'options' => [], 'selected' => null, 'required' => false])

<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <select class="form-select" id="{{ $name }}" name="{{ $name }}"
        @if ($required) required @endif>
        <option value="" disabled {{ $selected ? '' : 'selected' }}>
            Selecione {{ strtolower($label) }}
        </option>

        @foreach ($options as $value => $text)
            <option value="{{ $value }}"
                {{ (string) old($name, $selected) === (string) $value ? 'selected' : '' }}>
                {{ $text }}
            </option>
        @endforeach
    </select>
</div>
