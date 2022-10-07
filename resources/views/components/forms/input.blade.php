<div class="form-group">
    <label for="{{ $name }}">
        {{ $label }}
        @if ($required)
            <span class="text-danger">*</span>
        @endif
    </label>

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

        wire:model{{ $wireModifier === '' ? '' : ".$wireModifier" }}="{{ $wire }}"
    >
    @error($name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>