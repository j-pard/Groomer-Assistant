<div class="form-check form-switch d-flex align-items-center ">
    <input 
        class="form-check-input me-2" 
        type="checkbox" 
        {{ $name ? 'name="' . $name . '"' : ''}}
        id="checkbox{{ $name }}" 
        {{ $checked ? 'checked' : ''}}

        wire:model.live="{{ $wire }}"
    >

    <label class="form-check-label d-flex align-items-center" for="checkbox{{ $name }}">
        <span wire:dirty wire:target="{{ $name }}" class="text--copper mx-1"><i class="fa-solid fa-spinner dirty-spinner"></i></span>
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