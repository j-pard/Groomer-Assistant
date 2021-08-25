<div class="form-group">
    <label for="{{ $name }}">
        {{ $label }}
        @if ($label && $required)
            <span class="text-danger">*</span>
        @endif
    </label>

    <select 
        class="form-control {{ $class }} @error($name) is-invalid @enderror"
        {{ $name ? 'name="' . $name . '"' : ''}}
        {{ $id ? 'id="' . $id . '"' : ''}}
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : ''}}
        {{ $readonly ? 'readonly' : '' }}
        {{ $disabled ? 'disabled' : '' }}

        @if ($wire)
            wire:model{{ $wireModifier === '' ? '' : ".$wireModifier" }}="{{ $wire }}"
        @else
            value="{{ $errors->$name ? old($name) : $value }}"
        @endif
    >
        <option value=""></option>
        @forelse($options as $value => $label)
            <option
                @if(!$wire && $isSelected($value)) selected="selected" @endif
                value="{{ $value }}"
                wire:="{{ $wire }}"
            >
                {{ $label }}
            </option>
        @empty
            <option value="null" disabled></option>
        @endforelse
    </select>

</div>
