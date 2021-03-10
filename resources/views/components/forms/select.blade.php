<div class="form-group">
    @if (isset($label) && $required)
        <label for="{{ $name }}">
            {{ $label }}
            <span class="text-danger ml-1">*</span>
        </label>
    @elseif (isset($label))
        <label for="{{ $id }}">{{ $label }}</label>
    @endif

    <select 
        class="form-control {{ $class }}"
        @if (isset($name))
            name="{{ $name }}"
        @endif
        @if (isset($id))
            id="{{ $id }}"
        @endif
        {{ $required ? 'required' : '' }}
        {{ $readonly ? 'readonly' : '' }}
        {{ $disabled ? 'disabled' : '' }}
    >
        @php
            foreach ($options as $key => $value) {
                if (isset($model) && $model === $key) {
                    echo('<option value="' . $key . '" selected>' . ucfirst($value) .'</option>');
                } else {
                    echo('<option value="' . $key . '">' . ucfirst($value) .'</option>');
                }
            }
        @endphp
    </select>
</div>
