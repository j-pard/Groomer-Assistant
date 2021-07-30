<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <input 
        class="form-control {{ $class }} @error($name) is-invalid @enderror"
        {{ $type ? 'type="' . $type . '"' : ''}}
        {{ $name ? 'name="' . $name . '"' : ''}}
        {{ $id ? 'id="' . $id . '"' : ''}}
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