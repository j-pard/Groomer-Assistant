<div class="form-group">
    <label for="{{ $name }}">
        {{ $label }}
        @if ($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    <textarea 
        class="form-control {{ $class }}"
        {{ $name ? 'name="' . $name . '"' : ''}}
        {{ $id ? 'id="' . $id . '"' : ''}}
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : ''}}
        {{ $readonly ? 'readonly' : '' }}
        {{ $disabled ? 'disabled' : '' }}
        {{ $cols ? 'cols=' . $cols : ''}}
        {{ $rows ? 'rows=' . $rows : ''}}

        @if ($wire)
            wire:model{{ $wireModifier === '' ? '' : ".$wireModifier" }}="{{ $wire }}"
        @else
            value="{{ $errors->$name ? old($name) : $value }}"
        @endif
    >
    </textarea>

    @error($name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>