<div class="form-group">
    <div class="form-floating {{ $classContainer ?? 'mb-4' }}">
        <textarea 
            class="form-control {{ $class }}"
            {{ $name ? 'name="' . $name . '"' : ''}}
            {{ $id ? 'id="' . $id . '"' : ''}}
            placeholder="{{ $placeholder }}"
            {{ $required ? 'required' : ''}}
            {{ $readonly ? 'readonly' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            {{ $cols ? 'cols=' . $cols : ''}}
            style="min-height: {{ $rows }}"

            @if ($lazy)
                wire:model="{{ $wire }}"
            @else
                wire:model.live.debounce.1000ms="{{ $wire }}"
            @endif
        >
        </textarea>

        @if ($label)
            <label for="{{ $name }}">
                @if (!$lazy)
                    <span wire:dirty wire:target="{{ $name }}" class="text--copper mx-1"><i class="fa-solid fa-spinner dirty-spinner"></i></span>
                @endif
                {{ $label }}
                @if ($required)
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