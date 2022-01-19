<div>
    <a href="{{ isset($url) ? $url : '' }}" 
        class="btn btn-nav {{ isset($class) ? $class : '' }}" 
        section="{{ isset($section) ? $section : '' }}"
    >
        <i class="{{ $icon }} {{ $active ? 'nav-active' : '' }}"></i>
    </a>
</div>