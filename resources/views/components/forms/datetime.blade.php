<div class="form-group">
    @if ($label)
        <label for="{{ $name }}">
            @if (!$lazy)
                <span wire:dirty wire:target="{{ $name }}" class="text--copper mx-1"><i class="fa-solid fa-spinner dirty-spinner"></i></span>
            @endif
            {{ $label }}
            @if ($required)
                <span class="text--copper">*</span>
            @endif
        </label>
    @endif

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

        @if ($lazy)
            wire:model="{{ $wire }}"
        @else
            wire:model.live.debounce.500ms="{{ $wire }}"
        @endif
    >
    
    @error($name)
        <div class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
</div>