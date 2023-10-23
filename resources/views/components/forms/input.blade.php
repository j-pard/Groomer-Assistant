<div class="form-group">
    <div class="form-floating mb-4">
        <input 
            class="form-control {{ $class }} @error($name) is-invalid @enderror"
            type="{!! $type !!}"
            name="{!! $name !!}"
            {!! $placeholder ? 'placeholder="' . $placeholder . '"' : "" !!}
            {!! $id ? 'id="' . $id . '"' : "" !!}
            {!! $required ? 'required' : '' !!}
            {!! $readonly ? 'readonly' : '' !!}
            {!! $disabled ? 'disabled' : '' !!}
            {!! $maxlength ? 'maxlength="' . $maxlenght . '"' : '' !!}
            {!! isset($step) ? 'step="' . $step . '"' : '' !!}
            {!! isset($min) ? 'min="' . $min . '"' : '' !!}
            {!! isset($max) ? 'max="' . $max . '"' : '' !!}
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
                @if ($required)
                    <span class="text--copper">*</span>
                @endif
            </label>
        @endif
        
        @error($name)
            <div class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>
</div>