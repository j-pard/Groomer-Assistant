<div class="sticky-top bg--dark-900 py-3">
    <div class="row">
        <div class="d-flex justify-content-between align-items-start">
            <x-forms.price
                label="Total TVA"
                wire="tva"
                help="{{ $tvaCount }} chiens"
                disabled
            />

            <x-forms.price
                label="Voie électronique"
                wire="bank"
                help="{{ $bankCount }} chiens"
                disabled
            />

            <x-forms.price
                label="Total HTVA"
                wire="htva"
                help="{{ $htvaCount }} chiens"
                disabled
            />

            <x-forms.price
                label="Cumul"
                wire="cumulated"
                help="{{ $cumulatedCount }} chiens"
                disabled
            />

            <x-forms.price
                label="Franchise"
                wire="remaining"
                help="{{ $totalOfYearCount }} chiens sur l'année"
                disabled
            />

            <div id="calendar-input" class="d-flex align-items-center">
                <button type="button" class="btn btn-transparent" wire:click="previousMonth">
                    <i class="fas fa-backward text--quartz"></i>
                </button>

                <x-forms.datepicker
                    type="month"
                    wire="activeMonth"
                    wireModifier="lazy"
                />

                <button type="button" class="btn btn-transparent" wire:click="nextMonth">
                    <i class="fas fa-forward text--quartz"></i>
                </button>
            </div>
        </div>
    </div>
</div>