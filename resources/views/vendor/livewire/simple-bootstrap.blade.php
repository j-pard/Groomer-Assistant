<div class="livewire-custom-pagination">
    @if ($paginator->hasPages())
        <div class="d-flex justify-content-around">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <div class="page-item disabled m-1 p-1" aria-disabled="true">
                    <span class="page-link"><i class="fa-solid fa-angle-left"></i></span>
                </div>
            @else
                <div class="page-item m-1 p-1">
                    <button type="button" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" class="page-link" wire:click="previousPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" rel="prev">
                        <i class="fa-solid fa-angle-left"></i>
                    </button>
                </div>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <div class="page-item m-1 p-1">
                    <button type="button" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" class="page-link" wire:click="nextPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" rel="next">
                        <i class="fa-solid fa-angle-right"></i>
                    </button>
                </div>
            @else
                <div class="page-item disabled m-1 p-1" aria-disabled="true">
                    <span class="page-link"><i class="fa-solid fa-angle-right"></i></span>
                </div>
            @endif
        </div>
    @endif
</div>
