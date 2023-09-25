<div class="form-group">
    <label for="{{ $name }}">
        {{ $label }}
        @if ($required)
            <span class="text--copper">*</span>
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

        wire:model="{{ $wire }}"
    >
    </textarea>

    @error($name)
        <div class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
</div>