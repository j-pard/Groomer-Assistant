
<div>
    <form wire:submit="save">
        <h4 class="mb-3">Encore quelques petits détails ...</h4>

        <div class="d-flex flex-column pt-3 pb-1 mb-1" wire:loading.class="opacity-50">
            <div class="mb-3">
                <div class="col-12 mb-4">
                    <h3 class="mb-3 text--copper">Essentiels</h3>
                    <x-forms.input
                        label="Nom"
                        wire="name"
                        required
                        min="2"
                        max="100"
                        lazy
                    />

                    <div class="form-group mb-3">
                        <x-forms.radio
                            value="unknown"
                            icon="fa-solid fa-question h5"
                            inline
                            checked
                            wire="genre"
                            lazy
                        />
                        <x-forms.radio
                            value="male"
                            icon="fa-solid fa-mars h5"
                            inline
                            wire="genre"
                            lazy
                        />
                        <x-forms.radio
                            value="female"
                            icon="fa-solid fa-venus h5"
                            inline
                            wire="genre"
                            lazy
                        />
                    </div>

                    <div class="row align-items-center">
                        <x-forms.select
                            classContainer="col-md-6"
                            label="Race"
                            wire="main_breed_id"
                            :options="$breeds"
                            hasEmptyRow
                            required
                            lazy
                        />

                        <div class="col text-center mb-2 cell-desktop">
                            <i class="fa-solid fa-shuffle text--quartz h5"></i>
                        </div>

                        <x-forms.select
                            classContainer="col-md-5"
                            label="Croisement"
                            wire="second_breed_id"
                            :options="$breeds"
                            hasEmptyRow
                            lazy
                        />
                    </div>
                </div>

                <div class="col-12 mb-4">
                    <h3 class="mb-3 text--copper">Propriétaire</h3>
                    @if ($owner_id !== null)
                        <p class="text--quartz">{{ $owner_name . ' - ' . $owner_phone }}</p>
                    @else
                        <x-forms.input
                            label="Nom du propriétaire"
                            wire="owner_name"
                            required
                            min="2"
                            max="100"
                            lazy
                        />

                        <x-forms.input
                            label="Numéro de téléphone"
                            wire="owner_phone"
                            required
                            min="6"
                            max="50"
                            lazy
                        />
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <button role="submit" class="text-white btn btn-primary--copper px-3">
                        Créer le chien
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
