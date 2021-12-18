<div class="form-group">
    <label for="{{ $name }}">
        {{ $label }}
        @if ($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    <input 
        class="form-control {{ $class }} @error($name) is-invalid @enderror"
        type="file"
        name="{!! $name !!}"
        {!! $placeholder ? 'placeholder="' . $placeholder . '"' : "" !!}
        {!! $id ? 'id="' . $id . '"' : "" !!}
        {!! $required ? 'required' : '' !!}
        {!! $readonly ? 'readonly' : '' !!}
        {!! $disabled ? 'disabled' : '' !!}
        {!! $accept ? 'accept="' . $accept . '"' : "" !!}

        wire:model{{ $wireModifier === '' ? '' : ".$wireModifier" }}="{{ $wire }}"
    >
    @error($name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
