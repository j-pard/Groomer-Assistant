<div class="form-check {{ $inline ? 'form-check-inline' : '' }}">
    <input 
        class="form-check-input" 
        type="radio" 
        {{ $name ? 'name="' . $name . '"' : ''}}
        id="radio{{ $value }}" 
        value="{{ $value }}" 
        {{ $checked ? 'checked' : ''}}

        wire:model.live.debounce.500ms="{{ $wire }}"
    >

    <label class="form-check-label" for="radio{{ $value }}">
        <span wire:dirty wire:target="{{ $name }}" class="text--copper mx-1"><i class="fa-solid fa-spinner dirty-spinner"></i></span>
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