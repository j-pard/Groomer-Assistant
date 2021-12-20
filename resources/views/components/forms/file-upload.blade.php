<div class="form-group">
    <div class="input-group">
        <input 
            aria-describedby="button-addon2"
            class="form-control mb-0 {{ $class }} @error($name) is-invalid @enderror"
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

        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Upload</button>
    </div>
    @error($name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
