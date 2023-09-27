<div class="form-group">
    <label for="{{ $name }}">
        <span wire:dirty wire:target="{{ $name }}" class="text--copper mx-1"><i class="fa-solid fa-spinner dirty-spinner"></i></span>
        {{ $label }}
        @if ($required)
            <span class="text--copper">*</span>
        @endif
    </label>

    <input 
        class="form-control {{ $class }} @error($name) is-invalid @enderror"
        type="datetime-local"
        name="{!! $name !!}"
        {!! $id ? 'id="' . $id . '"' : "" !!}
        {!! $required ? 'required' : '' !!}
        {!! $readonly ? 'readonly' : '' !!}
        {!! $disabled ? 'disabled' : '' !!}
        {!! $min ? 'min="' . $min . '"' : '' !!}
        {!! $max ? 'max="' . $max . '"' : '' !!}

        wire:model="{{ $wire }}"
    >
    
    @error($name)
        <div class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
</div>