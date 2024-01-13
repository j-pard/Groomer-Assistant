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
                <div>
                    <div class="row">
                        <div class="col-6">
                            <x-forms.input
                                label="Date"
                                type="date"
                                wire="apptDate"
                                required
                                lazy
                            />
                        </div>
                        <div class="col-6">
                            <x-forms.input
                                label="Heure"
                                type="time"
                                wire="apptTime"
                                required
                                lazy
                            />
                        </div>
                    </div>
                
                    <div class="row">
                        <x-forms.input
                            label="Nom du chien"
                            wire="dogName"
                            disabled
                            required
                            lazy
                        />
                
                        <x-forms.input
                            label="Propriétaire"
                            wire="ownerName"
                            disabled
                            required
                            lazy
                        />
                    </div>
                
                    <div class="row mb-4">
                        <x-forms.textarea
                            label="Notes"
                            rows="10"
                            wire="apptNotes"
                            lazy
                        />
                    </div>
                </div>
            </div>

            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-transparent text--light-100 hoverable me-1" data-bs-dismiss="modal">Annuler</button>

                @if ($dogId !== null)
                    <button role="button" wire:click="saveAppointment" class="text-white btn btn-primary--copper">Ajouter</button>
                @endif
            </div>
        </div>
    </div>
</div>