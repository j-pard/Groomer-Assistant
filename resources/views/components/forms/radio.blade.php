<div class="form-check {{ isset($inline) ? 'form-check-inline' : '' }}">
    <input class="form-check-input" type="radio" name="{{ $name }}" id="radio{{ $value }}" value="{{ $value }}" {{ $selected ? 'checked' : ''}}>
    <label class="form-check-label" for="radio{{ $value }}">
        @if ($isIcon)
            <i class="{{ $label }} h4"></i>
        @else
            {{ !empty($label) ? $label : ucfirst($value) }}
        @endif
    </label>
</div>