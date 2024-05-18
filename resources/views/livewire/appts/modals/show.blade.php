<div 
    wire:ignore.self class="modal fade"id="apptModal" tabindex="-1" aria-labelledby="apptModalLabel" aria-hidden="true"
    x-data
    x-init="$refs.modal.addEventListener('hide.bs.modal', function () { $wire.call('resetAppointment') })"
    x-ref="modal"
>
    <div class="modal-dialog {{ ($isModalXl) ? 'modal-xl' : '' }}">
        <div class="modal-content bg--dark-700 text--light-100">
            <div class="modal-header">
                <h4 class="modal-title">Rendez-vous de <strong class="text--copper">{{ $dogName }}</strong></h4>
                <button type="button" class="btn-close text--light-200" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row {{ ($isModalXl) ? 'justify-content-between' : '' }}">
                    {{-- Left column --}}
                    <div class="{{ ($isModalXl) ? 'col-md-6' : '' }}">
                        <div class="row">
                            <div class="col-6">
                                <x-forms.input
                                    label="Date"
                                    type="date"
                                    wire="apptDate"
                                    required
                                />
                            </div>
                            <div class="col-6">
                                <x-forms.input
                                    label="Heure"
                                    type="time"
                                    wire="apptTime"
                                    required
                                />
                            </div>
                        </div>

                        <div class="row d-flex align-items-center mb-4">
                            <div class="col">
                                <x-forms.input
                                    label="Nom du chien"
                                    wire="dogName"
                                    required
                                    disabled
                                    classContainer="mb-0"
                                />
                            </div>

                            @if (isset($showTimelineLink) && $showTimelineLink)
                                <div class="col-1">
                                    <a href="{{ route('dogs.timeline', ['dog' => $dogId]) }}" target="_blank" class="btn btn--secondary text--quartz hoverable ms-0 ps-0">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                </div>
                            @endif
                        </div>

                        <div class="mb-4">
                            <x-forms.textarea
                                label="Notes"
                                rows="10"
                                wire="apptNotes"
                            />
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <x-forms.select
                                    label="Status"
                                    wire="apptStatus"
                                    :options='$statuses'
                                    required
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
                                />
                            </div>
                        </div>
                    </div>

                    {{-- Right column --}}
                    @if ($isModalXl)
                        <div class="col-md-5">
                            <h3 class="mb-3">
                                <i class="fas fa-exclamation-circle text--copper h3 me-2"></i>
                                Attention
                            </h3>

                            <div class="row mb-4">
                                <x-forms.textarea
                                    rows="10"
                                    wire="dogDetails"
                                    disabled
                                />
                            </div>
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="text-center">
                        <a type="button" class="btn deletable" title="Supprimer le rendez-vous" data-confirm="Le rendez-vous sera supprimé définitivement." data-confirm-action="@this.deleteAppointment()">
                            <i class="fa-solid fa-trash-can"></i> Supprimer le rendez-vous
                        </a>
                    </div>
                </div>

            </div>
            <div class="modal-footer d-flex justify-content-start">
                <button type="button" class="btn btn-transparent text--light-100 hoverable" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>