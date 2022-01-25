<header>
    <div class="row">
        <div class="d-flex justify-content-around align-items-center">
            <x-forms.price
                label="Total TVA"
                wire="tva"
                class="mb-0"
                help="{{ $tvaCount }} chiens"
            />

            <x-forms.price
                label="Total HTVA"
                wire="htva"
                class="mb-0"
                help="{{ $htvaCount }} chiens"
            />

            <x-forms.price
                label="Cumul"
                wire="cumulated"
                class="mb-0"
                help="{{ $cumulatedCount }} chiens"
            />

            <x-forms.price
                label="Franchise"
                wire="remaining"
                class="mb-0"
                help="{{ $totalOfYearCount }} chiens sur l'année"
            />

            <div id="calendar-input" class="d-flex align-items-center mt-2">
                <button type="button" class="btn btn-transparent mb-2" wire:click="previousMonth">
                    <i class="fas fa-backward"></i>
                </button>

                <x-forms.datepicker
                    type="month"
                    wire="activeMonth"
                    wireModifier="lazy"
                    class="mb-0"
                />

                <button type="button" class="btn btn-transparent mb-2" wire:click="nextMonth">
                    <i class="fas fa-forward"></i>
                </button>
            </div>
        </div>
    </div>
</header>