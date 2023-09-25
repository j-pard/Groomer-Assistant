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

            wire:model="{{ $wire }}"
        >

        <label for="{{ $name }}">
            {{ $label }}
            @if ($required)
                <span class="text--copper">*</span>
            @endif
        </label>
        
        @error($name)
            <div class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>
</div>