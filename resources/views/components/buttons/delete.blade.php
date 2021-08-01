<div class="dropdown dropstart">
    <button type="button" class="btn btn-delete" data-bs-toggle="dropdown" id="{{ $id }}" aria-expanded="false">
        <i class="fas fa-times"></i>
    </button>

    <ul class="dropdown-menu dropdown-menu-start" aria-labelledby="{{ $id }}">
        <li>
            <a class="dropdown-item bg-danger text-white" role="button"
                @if ($wire)
                    wire:click="{{ $wire }}"
                @endif
            >
                {{ $text }}
            </a>
        </li>
    </ul>
</div>
