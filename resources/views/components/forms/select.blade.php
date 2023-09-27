<div class="form-group {!! $classContainer !!}">
    <div class="form-floating mb-4">
        <select 
            {!! $attributes->merge(['class' => "form-control " . $class]) !!}
            name="{!! $name !!}"
            {!! $id ? 'id="' . $id . '"' : "" !!}
            {!! $required ? 'required' : '' !!}
            {!! $readonly ? 'readonly' : '' !!}
            {!! $disabled ? 'disabled' : '' !!}

            wire:model.live="{{ $wire }}"
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

        @if ($label)
            <label for="{{ $name }}">
                <span wire:dirty wire:target="{{ $name }}" class="text--copper mx-1"><i class="fa-solid fa-spinner dirty-spinner"></i></span>
                {{ $label }}
                @if ($label && $required)
                    <span class="text--copper">*</span>
                @endif
            </label>
        @endif

        @error($name)
            <div class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>
</div>
