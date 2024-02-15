<div class="form-group">
    <div class="input-group mb-0">
        <span class="input-group-text mb-0">€</span>
        <div class="form-floating mb-0">
            <input 
                class="form-control {{ $class }} @error($name) is-invalid @enderror"
                type="number"
                disabled
                name="{!! $name !!}"
                {!! $placeholder ? 'placeholder="' . $placeholder . '"' : "" !!}
                {!! isset($value) ? 'value="' . $value . '"' : '' !!}
    
                @if ($lazy)
                    wire:model="{{ $wire }}"
                @else
                    wire:model.live.debounce.500ms="{{ $wire }}"
                @endif
            >
    
            @if ($label)
                <label for="{{ $name }}">
                    @if (!$lazy)
                        <span wire:dirty wire:target="{{ $name }}" class="text--copper mx-1"><i class="fa-solid fa-spinner dirty-spinner"></i></span>
                    @endif
                    {{ $label }}
                </label>
            @endif
        </div>
    </div>

    @if (isset($help))
        <small class="text--quartz ps-2">{!! $help !!}</small>
    @endif

    @error($name)
        <div class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
</div>