<a
    class="{{ $dropdown ? 'dropdown-item' : 'btn btn-delete' . $class }}"
    role="button"
    data-confirm="{{ $text }}"
    data-confirm-action="@this.{{ $method }}"
>
    <i class="{{ $icon . ($dropdown ? ' text-secondary me-3' : '') }}"></i>
    {{ $button }}
</a>