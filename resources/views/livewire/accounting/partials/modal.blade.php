<div 
    wire:ignore.self class="modal fade" id="apptModal" tabindex="-1" aria-labelledby="apptModalLabel" aria-hidden="true"
    x-data
    x-init="$refs.modal.addEventListener('hide.bs.modal', function () { $wire.call('resetAppointment') })"
    x-ref="modal"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <form wire:submit.prevent="saveAppointment">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPetModalLabel">Rendez-vous</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-6">
                            <x-forms.datepicker
                                label="Date"
                                wire="date"
                                disabled
                            />
                        </div>
                        <div class="col-6">
                            <x-forms.input
                                label="Heure"
                                type="time"
                                wire="time"
                                disabled
                            />
                        </div>
                    </div>

                    <div class="mb-3">
                        <x-forms.input
                            label="Client"
                            wire="customerName"
                            disabled
                        />
                    </div>

                    <div class="mb-3">
                        <x-forms.input
                            label="Chien"
                            wire="petName"
                            disabled
                        />
                    </div>

                    <x-forms.textarea
                        label="Notes"
                        rows="4"
                        wire="appointment.notes"
                        disabled
                    />

                    <div class="row mb-3">
                        <div class="col-6">
                            <x-forms.select
                                label="Status"
                                wire="appointment.status"
                                :options='$availableStatus'
                                disabled
                            />
                        </div>

                        <div class="col-6">
                            <x-forms.price
                                label="Prix"
                                wire="appointment.price"
                                disabled
                            />
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>