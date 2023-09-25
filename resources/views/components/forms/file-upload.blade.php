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
            multiple

            wire:model="{{ $wire }}"
        >

        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Upload</button>
    </div>

    <div class="text--copper" wire:loading wire:target="{{ $wire }}">Uploading...</div>

    @error($name)
        <div class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
</div>
