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

            wire:model.live.debounce.500ms="{{ $wire }}"
        >

        <label for="{{ $name }}">
            <span wire:dirty wire:target="{{ $name }}" class="text--copper mx-1"><i class="fa-solid fa-spinner dirty-spinner"></i></span>
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