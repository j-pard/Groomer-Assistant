@if ($paginationEnabled)
    <div class="row d-flex align-items-center">
        @if ($paginationEnabled && count($perPageOptions))
            <div class="col-md-4 col-xl-2 d-flex flex-nowrap align-items-center">
                <div style="min-width:max-content">@lang('laravel-livewire-tables::strings.per_page') &nbsp;</div>

                <select wire:model="perPage" class="form-control mb-0">
                    @foreach ($perPageOptions as $option)
                        <option>{{ $option }}</option>
                    @endforeach
                </select>
            </div><!--col-->
        @endif

        <div class="col">
            <div class="col">
                {{ $models->links() }}
            </div>
    
            <div class="col text-end text-muted">
                @lang('laravel-livewire-tables::strings.results', [
                    'first' => $models->count() ? $models->firstItem() : 0,
                    'last' => $models->count() ? $models->lastItem() : 0,
                    'total' => $models->total()
                ])
            </div>
        </div>
    </div>
@endif
