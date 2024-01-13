<div class="skeleton">
    @if ($search)
        <div class="list-heading">
            <div class="input-group searchbar px-3 px-md-2">
                <div class="skeleton-cell skeleton-searchbar"></div>
            </div>
        </div>
    @endif

    <div class="d-flex flex-column pt-3 pb-1 mb-1">
        @for ($i = 0; $i < $rows; $i++)
            <div class="list-element mx-2 my-1 py-2 px-1 px-sm-3">
                <div class="d-flex flex-row col-md-4">
                    <div class="d-flex flex-row align-items-center">
                        <div class="avatar avatar-skeleton mx-2 mx-sm-4"></div>
                    </div>
                    <div class="d-flex flex-column text-end justify-content-between col-md-5">
                        <div class="skeleton-cell"></div>
                        <div class="skeleton-cell"></div>
                    </div>
                </div>

                <div class="cell-desktop-flex col-md-3">
                    <div class="d-flex flex-column text-end justify-content-between">
                        <div class="skeleton-cell"></div>
                        <div class="skeleton-cell"></div>
                    </div>
                </div>

                <div class="d-flex flex-column text-end justify-content-between align-items-end col-4">
                    <div class="skeleton-cell skeleton-cell-lg"></div>
                    <div class="skeleton-cell skeleton-cell-lg"></div>
                </div>
            </div>
        @endfor
    </div>

    @if ($pagination)
        <div class="d-flex justify-content-center mb-5 pt-3 pb-5 px-2">
            <div class="skeleton-cell skeleton-pagination"></div>
        </div>
    @endif
</div>
