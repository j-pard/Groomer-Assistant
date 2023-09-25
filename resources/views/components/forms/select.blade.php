<div class="form-group {!! $classContainer !!}">
    @if ($label)
        <label for="{{ $name }}">
            {{ $label }}
            @if ($label && $required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif

    <select 
        {!! $attributes->merge(['class' => "form-control " . $class]) !!}
        name="{!! $name !!}"
        {!! $id ? 'id="' . $id . '"' : "" !!}
        {!! $required ? 'required' : '' !!}
        {!! $readonly ? 'readonly' : '' !!}
        {!! $disabled ? 'disabled' : '' !!}

        wire:model="{{ $wire }}"
    >
        @if ($hasEmptyRow)
            <option value=""></option>
        @endif

        @forelse($options as $option)
            <option value="{{ $option['value'] }}" wire:key="{{ "$id-" . $option['value'] }}">
                {{ $option['label'] }}
            </option>
        @empty
            <option value="null" disabled></option>
        @endforelse
    </select>

    @error($name)
        <div class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
</div>
