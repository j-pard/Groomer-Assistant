<div class="form-group">
    @if (isset($label))
        <label for="{{ $name }}">
            {{ $label }}
            @if ($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif
    <input 
        class="form-control {{ $class }} @error($name) is-invalid @enderror"
        type="{!! $type !!}"
        name="{!! $name !!}"
        {!! $id ? 'id="' . $id . '"' : "" !!}
        {!! $required ? 'required' : '' !!}
        {!! $readonly ? 'readonly' : '' !!}
        {!! $disabled ? 'disabled' : '' !!}
        {!! $min ? 'min="' . $min . '"' : '' !!}
        {!! $max ? 'max="' . $max . '"' : '' !!}

        wire:model{{ $wireModifier === '' ? '' : ".$wireModifier" }}="{{ $wire }}"
    >
    @error($name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>