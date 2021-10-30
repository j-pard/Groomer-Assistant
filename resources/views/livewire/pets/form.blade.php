<div>
    <form wire:submit.prevent="save">
        <div class="card-body">
            <fieldset>
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="mb-3">Informations</h3>
                        
                        <div class="form-group">
                            <x-forms.radio
                                value="unknown"
                                icon="far fa-question-circle"
                                inline
                                checked
                                wire="pet.genre"
                            />
                            <x-forms.radio
                                value="male"
                                icon="fas fa-mars"
                                inline
                                wire="pet.genre"
                            />
                            <x-forms.radio
                                value="female"
                                icon="fas fa-venus"
                                inline
                                wire="pet.genre"
                            />
                        </div>
                        
                        <x-forms.input
                            label="Nom"
                            required
                            wire="pet.name"
                        />

                        <x-forms.select
                            label="Propriétaire"
                            :options='$customers'
                            required
                            wire="pet.customer_id"
                        />

                        <x-forms.datepicker
                            label="Anniversaire"
                            wire="birthdate"
                        />

                        <x-forms.select
                            label="Status"
                            :options='$status'
                            wire="pet.status"
                            required
                        />

                        <h4 class="mt-4 mb-3">Compléments</h4>
                        <div class="form-group d-flex flex-nowrap justify-content-between align-items-end">
                            <div class="col-md-5">
                                <x-forms.select
                                    label="Race 1"
                                    :options='$breeds'
                                    wire="pet.main_breed_id"
                                    required
                                />
                            </div>
                            <i class="fas fa-times h1 mx-3 my-auto"></i>
                            <div class="col-md-5">
                                <x-forms.select
                                    label="Race 2"
                                    :options='$breeds'
                                    wire="pet.second_breed_id"
                                />
                            </div>
                        </div>

                        <x-forms.select
                            label="Taille"
                            :options='$sizes'
                            required
                            wire="pet.size"
                        />

                        <div class="form-group">
                            <label>Durée moyenne <span class="text-danger ml-1">*</span></label>
                            <div class="duration-inputs-container">
                                <x-forms.input
                                    label="Heures"
                                    type="number"
                                    placeholder="0"
                                    min="0"
                                    wire="hours"
                                />
                                <div class="h4 mx-1">:</div>
                                <x-forms.input
                                    label="Minutes"
                                    type="number"
                                    placeholder="00"
                                    min="0"
                                    max="59"
                                    step="5"
                                    wire="minutes"
                                />
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <h3 class="mb-3">Détails</h3>
                        
                        <div class="form-group">
                            <x-forms.textarea
                                label="Remarques"
                                rows="10"
                                wire="pet.remarks"
                            />
                        </div>

                        @if ($pet->exists && isset($pet->customer))
                            <h3 class="mt-4 mb-3">
                                Propriétaire
                            </h3>
                            <div class="form-group">
                                <ul class="list-group list-unstyled">
                                    <li class="list-group-item">
                                        <a class="list-group-item-action text-decoration-none p-2 mr-3" href="{{ route('customers.edit', ['customer' => $pet->customer]) }}">
                                            <i class="fas fa-external-link-alt"></i>
                                        </a>
                                        <span>{{ $pet->customer->firstname . ' ' . $pet->customer->lastname }}</span>
                                    </li>
                                </ul>
                            </div>
                        @elseif ($pet->exists)
                            <h3 class="mt-4 mb-3">
                                <i class="fas fa-exclamation-triangle text-warning me-3"></i>Sans collier
                            </h3>
                        @endif
                    </div>
                </div>
            </fieldset>
        </div>
        
        <div class="form-actions-buttons">
            <x-buttons.save />
        </div>
    </form>
</div>
