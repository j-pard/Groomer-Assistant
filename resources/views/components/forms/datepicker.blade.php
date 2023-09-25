<div class="form-group">
    <label for="{{ $name }}">
        {{ $label }}
        @if ($required)
            <span class="text--copper">*</span>
        @endif
    </label>

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

        wire:model="{{ $wire }}"
    >

    @error($name)
        <div class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
</div>