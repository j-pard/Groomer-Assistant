<div 
    wire:ignore.self class="modal fade" id="apptModal" tabindex="-1" aria-labelledby="apptModalLabel" aria-hidden="true">
    <div class="modal-dialog {{ ($isUpdating && $pet->has_warning) ? 'modal-xl' : '' }}">
        <div class="modal-content">
            <form wire:submit.prevent="saveAppointment">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPetModalLabel">{{ $modalTitle }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row {{ ($isUpdating && $pet->has_warning) ? 'justify-content-between' : '' }}">
                        {{-- Left column --}}
                        <div class="{{ ($isUpdating && $pet->has_warning) ? 'col-md-6' : '' }}">
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
                                    wire="petId"
                                    :options="$pets"
                                    :disabled="$isUpdating"
                                    required
                                    wireModifier="lazy"
                                />
                            </div>
        
                            <x-forms.textarea
                                label="Notes"
                                rows="4"
                                wire="appointment.notes"
                            />
        
                            @if ($isUpdating)
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <x-forms.select
                                            label="Status"
                                            wire="appointment.status"
                                            :options='$status'
                                            required
                                        />
                                    </div>
        
                                    <div class="col-6">
                                        <x-forms.price
                                            label="Prix"
                                            wire="appointment.price"
                                        />
                                    </div>
                                </div>
                            @endif
                        </div>

                        {{-- Right column --}}
                        @if ($isUpdating && $pet->has_warning)
                            <div class="col-md-5">
                                <i class="fas fa-exclamation-circle text-pink h1"></i>

                                <p>{{ $pet->warnings }}</p>
                            </div>
                        @endif
                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <div>
                        @if ($isUpdating)
                            <x-buttons.delete 
                                text="Etes-vous certain(e) de vouloir supprimer ce rendez-vous ?" 
                                method="deleteAppt({{ $appointment->id }})" 
                                icon="" 
                                button="Supprimer"
                                class="w-auto"
                            />
                        @endif
                    </div>
                    <div>
                        <button type="button" class="btn btn-secondary me-1" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-success text-light">{{ $isUpdating ? 'Sauver' : 'Ajouter' }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>