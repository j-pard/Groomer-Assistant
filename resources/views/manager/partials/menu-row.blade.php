<nav class="d-flex justify-content-center align-items-center">
    @foreach ($items as $item)
        <x-buttons.row
            icon="{{ $item['icon'] }}"
            url="{{ $item['url'] }}" 
        />
    @endforeach
</nav>