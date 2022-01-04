<div class="form-group">
    <label for="{{ $name }}">
        {{ $label }}
        @if ($required)
            <span class="text-danger">*</span>
        @endif
    </label>
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

            wire:model{{ $wireModifier === '' ? '' : ".$wireModifier" }}="{{ $wire }}"
        >
    </div>
    
    @error($name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>