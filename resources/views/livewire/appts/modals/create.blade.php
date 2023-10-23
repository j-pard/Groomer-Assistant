<div 
    wire:ignore.self class="modal fade"id="createApptModal" tabindex="-1" aria-labelledby="createApptModalLabel" aria-hidden="true"
    x-data
    x-init="$refs.modal.addEventListener('hide.bs.modal', function () { $wire.call('resetAppointment') })"
    x-ref="modal"
>
    <div class="modal-dialog">
        <div class="modal-content bg--dark-700 text--light-100">
            <form wire:submit.prevent="saveAppointment">
                <div class="modal-header">
                    <h4 class="modal-title">Nouveau rendez-vous</h4>
                    <button type="button" class="btn-close text--light-200" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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

                    <div class="row d-flex align-items-center">
                        <x-forms.select
                            label="Nom du chien"
                            wire="dogId"
                            :options="$dogs"
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

                    <div class="row mb-3">
                        <div class="col-6">
                            <x-forms.select
                                label="Status"
                                wire="apptStatus"
                                :options="$statuses"
                                required
                                lazy
                            />
                        </div>

                        <div class="col-6">
                            <x-forms.input
                                label="Prix €"
                                wire="apptPrice"
                                required
                                type="number"
                                step="0.05"
                                min="0"
                                lazy
                            />
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-transparent text--light-100 hoverable me-1" data-bs-dismiss="modal">Annuler</button>
                    <button role="submit" class="text-white btn btn-primary--copper">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>