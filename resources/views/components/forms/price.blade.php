<div class="form-group">
    <div class="form-floating {{ $classContainer ?? 'mb-4' }}">
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
        
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">€</span>
            </div>

            <input 
                class="form-control {{ $class }} @error($name) is-invalid @enderror"
                type="number"
                name="{!! $name !!}"
                {!! $placeholder ? 'placeholder="' . $placeholder . '"' : "" !!}
                {!! $id ? 'id="' . $id . '"' : "" !!}
                {!! $required ? 'required' : '' !!}
                {!! $readonly ? 'readonly' : '' !!}
                {!! $disabled ? 'disabled' : '' !!}
                step="0.05"
                min="0"
                {!! $max ? 'max="' . $max . '"' : '' !!}

                @if ($lazy)
                    wire:model="{{ $wire }}"
                @else
                    wire:model.live.debounce.500ms="{{ $wire }}"
                @endif
            >
        </div>

        @if (isset($help))
            <small class="text-muted ps-2">{!! $help !!}</small>
        @endif
        
        @error($name)
            <div class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>
</div>