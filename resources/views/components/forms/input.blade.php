<div class="form-group">
    @if (isset($label) && $required)
        <label for="{{ $name }}">
            {{ $label }}
            <span class="text-danger ml-1">*</span>
        </label>
    @elseif (isset($label))
        <label for="{{ $name }}">{{ $label }}</label>
    @endif

    <input 
        type="{{ $type }}"
        class="form-control {{ $class }}"
        @if (isset($id))
            id="{{ $id }}"
        @endif
        @if (isset($name))
            name="{{ $name }}"
        @endif
        @if (isset($placeholder))
            placeholder="{{ $placeholder }}"
        @endif
        @if (isset($value))
            value="{{ $value }}"
        @endif
        @if ($type === 'number' && isset($min))
            min="{{ $min }}"
        @endif
        @if ($type === 'number' && isset($max))
            max="{{ $max }}"
        @endif
        {{ $required ? 'required' : '' }}
        {{ $readonly ? 'readonly' : '' }}
        {{ $disabled ? 'disabled' : '' }}
    >
</div>