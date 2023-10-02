<div class="form-group">
    <label for="{{ $name }}">
        <span wire:dirty wire:target="{{ $name }}" class="text--copper mx-1"><i class="fa-solid fa-spinner dirty-spinner"></i></span>
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

        wire:model.live.debounce.1000ms="{{ $wire }}"
    >
    </textarea>

    @error($name)
        <div class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
</div>