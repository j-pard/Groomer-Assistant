
<div>
    <h4 class="mb-3">Et le propriétaire, tu le connais ?</h4>
    <x-forms.input
        label="Nom du propriétaire"
        wire="owner_name"
        required
        min="2"
        max="100"
    />

    <div class="d-flex flex-column pt-3 pb-1 mb-1" wire:loading.class="opacity-50">
        @if ($existingOwners !== null)
            <div class="mb-3">
                @if ($existingOwners->count() > 0)
                    <p>Tu peux <strong>sélectionner</strong> un propriétaire de la liste ci-dessous pour l'attribuer ou en <strong>créer un nouveau</strong>.</p>
                @endif

                @forelse ($existingOwners as $existingOwner)
                    <label class="list-element justify-content-start mx-2 my-2 p-2" for="owner_{{ $existingOwner->id }}">
                        <div class="d-flex justify-content-center align-items-center mx-3">
                            <x-forms.radio
                                id="owner_{{ $existingOwner->id }}"
                                wire="owner_id"
                                :value="$existingOwner->id"
                            />
                        </div>
                        
                        <div class="d-flex flex-row col-md-5">
                            <div class="d-flex flex-column">
                                {{ $existingOwner->name }}
                                <div class="text--quartz">{{ $existingOwner->phone }}</div>
                            </div>
                        </div>

                        <div class="d-flex flex-column text-end justify-content-between ms-auto col-md-4">
                            <div>{{ $existingOwner->city }}</div>
                        </div>
                    </label>
                @empty
                    <div>
                        Pas de propriétaire connu avec ce nom.
                    </div>
                @endforelse

                @if ($existingOwners->count() > 0 && $owner_id !== null)
                    <div class="text-light my-2">
                        <a wire:click="resetOwnerId" class="text-white btn btn-primary--quartz">
                            <i class="fa-solid fa-delete-left mx-2"></i >Effacer la sélection
                        </a>
                    </div>
                @endif
            </div>
        @endif

        @if (strlen($owner_name) >= 2)
            <div class="row">
                <div class="col">
                    <button role="button" wire:click="nextStep('creation')" class="text-white btn btn-primary--copper px-3">
                        {{ $owner_id !== null ? 'Sélectionner' : 'Créer' }}
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>
