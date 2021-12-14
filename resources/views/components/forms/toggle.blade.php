<div class="form-check form-switch d-flex align-items-center ">
    <input 
        class="form-check-input me-2" 
        type="checkbox" 
        {{ $name ? 'name="' . $name . '"' : ''}}
        id="checkbox{{ $name }}" 
        {{ $checked ? 'checked' : ''}}

        @if ($wire)
            wire:model{{ $wireModifier === '' ? '' : ".$wireModifier" }}="{{ $wire }}"
        @endif
    >

    <label class="form-check-label d-flex align-items-center" for="checkbox{{ $name }}">
        @if ($icon)
            <i class="{{ $icon }} {{ $iconClass }}"></i>
        @endif
        <span>{{ $label }}</span>
    </label>
</div>