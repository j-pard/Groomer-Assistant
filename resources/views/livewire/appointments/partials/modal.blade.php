<div 
    wire:ignore.self class="modal fade" id="apptModal" tabindex="-1" aria-labelledby="apptModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form wire:submit.prevent="saveAppointment">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPetModalLabel">{{ $modalTitle }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <x-forms.datepicker
                                label="Date"
                                wire="date"
                                required
                            />
                        </div>
                        <div class="col-6">
                            <x-forms.input
                                label="Heure"
                                type="time"
                                wire="time"
                                required
                            />
                        </div>
                    </div>

                    <div class="mb-3">
                        <x-forms.select
                            label="Client"
                            wire="customer"
                            :options="$customers"
                            required
                            :disabled="$isUpdating"
                            hasEmptyRow
                            wireModifier="lazy"
                        />
                    </div>

                    <div class="mb-3">
                        <x-forms.select
                            label="Chien"
                            wire="pet"
                            :options="$pets"
                            :disabled="$isUpdating"
                            required
                        />
                    </div>

                    <x-forms.textarea
                        label="Notes"
                        rows="8"
                        wire="appointment.notes"
                    />

                    @if ($isUpdating)
                        <div class="mb-3">
                            <x-forms.select
                                label="Status"
                                wire="appointment.status"
                                :options="$status"
                                required
                            />
                        </div>
                    @endif

                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <div>
                        @if ($isUpdating)
                            <button type="button" class="btn btn-danger" wire:click="deleteAppt({{ $appointment->id }})">Supprimer</button>
                        @endif
                    </div>
                    <div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-success text-light">{{ $isUpdating ? 'Sauver' : 'Ajouter' }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>