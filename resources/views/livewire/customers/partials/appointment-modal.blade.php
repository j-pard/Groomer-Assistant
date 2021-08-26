<div class="modal fade" id="apptModal" tabindex="-1" aria-labelledby="apptModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <form wire:submit.prevent="saveAppointment">
                <div class="modal-header">
                    <h5 class="modal-title" id="apptModalLabel">Ajouter un Rendez-vous</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {{-- LEFT COLUMN --}}
                        <div class="col-md-6">
                            <div class="row">
                                <div class="form-group col-6">
                                    <x-forms.input
                                        label="Date"
                                        type="date"
                                        wire="date"
                                        required
                                    />
                                </div>
                                <div class="form-group col-6">
                                    <x-forms.input
                                        label="Heure"
                                        type="time"
                                        wire="time"
                                        required
                                    />
                                </div>
                            </div>

                            <x-forms.input
                                label="Propriétaire"
                                wire="title"
                                disabled
                            />

                            <x-forms.select
                                wire="petId"
                                :options="$pets"
                                required
                            />
                            
                        </div>
        
                        {{-- RIGHT COLUMN --}}
                        <div class="col-md-6">
                            <x-forms.textarea
                                label="Notes"
                                rows="8"
                                wire="appointment.notes"
                            />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn--primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>
