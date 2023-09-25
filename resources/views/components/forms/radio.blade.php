<div class="form-check {{ $inline ? 'form-check-inline' : '' }}">
    <input 
        class="form-check-input" 
        type="radio" 
        {{ $name ? 'name="' . $name . '"' : ''}}
        id="radio{{ $value }}" 
        value="{{ $value }}" 
        {{ $checked ? 'checked' : ''}}

        wire:model="{{ $wire }}"
    >

    <label class="form-check-label" for="radio{{ $value }}">
        @if ($icon)
            <i class="{{ $icon }} {{ $iconClass }}"></i>
        @endif
        {{ $label }}
    </label>

    @error($name)
        <div class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
</div>