<div 
    wire:ignore.self class="modal fade"id="createApptModal" tabindex="-1" aria-labelledby="createApptModalLabel" aria-hidden="true"
    x-data
    x-init="$refs.modal.addEventListener('hide.bs.modal', function () { $wire.call('resetAppointment') })"
    x-ref="modal"
>
    <div class="modal-dialog">
        <div class="modal-content bg--dark-700 text--light-100">
            <div class="modal-header">
                <h4 class="modal-title">Nouveau rendez-vous</h4>
                <button type="button" class="btn-close text--light-200" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="{{ $activeStep !== 1 ? 'd-none' : '' }}">
                    @include('livewire.appts.modals.steps.create_step1')
                </div>

                <div class="{{ $activeStep !== 2 ? 'd-none' : '' }}">
                    @include('livewire.appts.modals.steps.create_step2')
                </div>
            </div>

            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-transparent text--light-100 hoverable me-1" data-bs-dismiss="modal">Annuler</button>

                @if ($activeStep === 2 && $dogId !== null)
                    <button role="button" wire:click="saveAppointment" class="text-white btn btn-primary--copper">Ajouter</button>
                @endif
            </div>
        </div>
    </div>
</div>