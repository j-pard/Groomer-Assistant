<div class="form-group">
    <label for="{{ $name }}">
        {{ $label }}
        @if ($required)
            <span class="text-danger">*</span>
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

        wire:model{{ $wireModifier === '' ? '' : ".$wireModifier" }}="{{ $wire }}"
    >
    @error($name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>