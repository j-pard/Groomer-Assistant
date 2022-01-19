<div class="form-check {{ $inline ? 'form-check-inline' : '' }}">
    <input 
        class="form-check-input" 
        type="radio" 
        {{ $name ? 'name="' . $name . '"' : ''}}
        id="radio{{ $value }}" 
        value="{{ $value }}" 
        {{ $checked ? 'checked' : ''}}

        @if ($wire)
            wire:model{{ $wireModifier === '' ? '' : ".$wireModifier" }}="{{ $wire }}"
        @endif
    >
    <label class="form-check-label" for="radio{{ $value }}">
        @if ($icon)
            <i class="{{ $icon }} {{ $iconClass }}"></i>
        @endif
        {{ $label }}
    </label>
</div>