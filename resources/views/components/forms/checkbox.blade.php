<div class="form-check d-flex align-items-center">
    <input 
        class="form-check-input me-2" 
        type="checkbox" 
        {{ $name ? 'name="' . $name . '"' : ''}}
        id="checkbox{{ $name }}" 
        {{ $checked ? 'checked' : ''}}

        wire:model="{{ $wire }}"
    >

    <label class="form-check-label d-flex align-items-center mt-2" for="checkbox{{ $name }}">
        @if ($icon)
            <i class="{{ $icon }} {{ $iconClass }}"></i>
        @endif
        <span>{{ $label }}</span>
    </label>

    @error($name)
        <div class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
</div>