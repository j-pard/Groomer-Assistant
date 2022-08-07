<div>
    <form wire:submit.prevent="save" autocorrect="off" autocapitalize="off" autocomplete="off">
        <button type="submit" onclick="return false;" style="display:none;"></button>
        <div class="card-body">
            <fieldset>
                <div class="row justify-content-between">
                    <div class="col-md-6 col-lg-5">
                        <h3 class="mb-3">Informations</h3>
                        
                        <div class="form-group">
                            <x-forms.radio
                                value="unknown"
                                icon="far fa-question-circle"
                                inline
                                checked
                                wire="customer.genre"
                                name="gender"
                            />
                            <x-forms.radio
                                value="male"
                                icon="fas fa-mars"
                                inline
                                wire="customer.genre"
                                name="gender"
                            />
                            <x-forms.radio
                                value="female"
                                icon="fas fa-venus"
                                inline
                                wire="customer.genre"
                                name="gender"
                            />
                        </div>
                        
                        <x-forms.input
                            label="Nom"
                            placeholder="Entrer le nom de famille"
                            required
                            wire="customer.lastname"
                        />
                        
                        <x-forms.input
                            label="Prénom"
                            placeholder="Entrer le prénom"
                            wire="customer.firstname"
                        />
                        
                        <div class="row">
                            <div class="col-md-4">
                                <x-forms.input
                                    label="Code postal"
                                    placeholder="0000"
                                    wire="customer.zip_code"
                                    type="numeric"
                                />
                            </div>
                            
                            <div class="col-md-8">
                                <x-forms.input
                                    label="Ville"
                                    placeholder="Entrer le nom de la ville"
                                    wire="customer.city"
                                />
                            </div>
                        </div>
                        
                        <x-forms.input
                            label="Adresse"
                            placeholder="Entrer l'adresse"
                            wire="customer.address"
                        />
                        
                        <h3 class="mt-4 mb-3">Contact</h3>
                        
                        <x-forms.input
                            label="Numéro de téléphone"
                            placeholder="Entrer le numéro"
                            wire="customer.phone"
                            type="tel"
                            required
                        />
                        
                        <x-forms.input
                            label="Numéro alternatif"
                            placeholder="Entrer le numéro alternatif"
                            wire="customer.secondary_phone"
                            type="tel"
                        />

                        <x-forms.input
                            label="Email"
                            type="email"
                            placeholder="Entrer l'adresse email"
                            wire="customer.email"
                        />

                        <div class="mb-3">
                            <x-forms.checkbox
                                label="Envoyer un message de rappel"
                                wire="customer.has_reminder"
                            />
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        
                        <h3 class="mb-3">Détails</h3>
                        <fieldset>
                            <x-forms.textarea
                                label="Remarques"
                                rows="10"
                                wire="customer.more_info"
                            />
                        </fieldset>
                        
                        @if ($customer->exists)
                            <h3 class="mt-4 mb-3">
                                Chiens
                                <a type="button" class="mx-3" title="Ajouter" wire:click="loadNewPetModal">
                                    <i class="fas fa-plus-circle text-success"></i>
                                </a>
                            </h3>
                            <div class="form-group">
                                <ul class="list-group list-unstyled">
                                    @forelse ($customer->pets->sortBy('name') as $pet)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <a class="list-group-item-action text-decoration-none p-2 mr-3" href="{{ route('pets.edit', ['pet' => $pet]) }}">
                                                    <i class="fas fa-external-link-alt"></i>
                                                </a>
                                                <span>{!! $pet->getName() !!}</span>
                                            </div>
                                            <x-buttons.delete 
                                                text="Etes-vous certain(e) de vouloir enlever le collier du chien ?" 
                                                method="detachPet({{ $pet->id }})" 
                                                icon="fas fa-times" 
                                            />
                                        </li>
                                    @empty
                                        
                                    @endforelse
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </fieldset>
        </div>
        
        <div class="form-actions-buttons">
            <x-buttons.save />
        </div>
    </form>

    @if ($customer->exists)
        @include('livewire.customers.partials.pet-modal')
    @endif
</div>