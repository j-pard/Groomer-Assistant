<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <input 
        class="form-control"
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $id }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : ''}}
        {{ $readonly ? 'readonly' : '' }}
        {{ $disabled ? 'disabled' : '' }}
        {{ $maxlength ? 'maxlength="' . $maxlenght . '"' : ''}}
        {{ $step ? 'step="' . $step . '"' : ''}}

        @if ($wire)
            wire:model.defer="{{ $wire }}"
        @else
            value="{{ $errors->$name ? old($name) : $value }}"
        @endif
    >
    @error($name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>