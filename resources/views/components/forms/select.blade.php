<div class="form-group">
    <label for="{{ $name }}">
        {{ $label }}
        @if ($label && $required)
            <span class="text-danger">*</span>
        @endif
    </label>

    <select 
        class="form-control {{ $class }} @error($name) is-invalid @enderror"
        name="{!! $name !!}"
        {!! $id ? 'id="' . $id . '"' : "" !!}
        {!! $required ? 'required' : '' !!}
        {!! $readonly ? 'readonly' : '' !!}
        {!! $disabled ? 'disabled' : '' !!}

        wire:model{{ $wireModifier === '' ? '' : ".$wireModifier" }}="{{ $wire }}"
    >
        @if ($hasEmptyRow)
            <option value=""></option>
        @endif

        @forelse($options as $value => $label)
            <option
                @if(!$wire && $isSelected($value)) selected="selected" @endif
                value="{{ $value }}"
                wire:="{{ $wire }}"
            >
                {{ $label }}
            </option>
        @empty
            <option value="null" disabled></option>
        @endforelse
    </select>
    @error($name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
