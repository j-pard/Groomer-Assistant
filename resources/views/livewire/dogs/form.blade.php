<div class="form-container p-4">
    <form wire:submit="save">
        <div class="row justify-content-between">
            <div class="col-12 col-md-5 mb-5">
                <h3 class="mb-3 text--copper">Essentiels</h3>
                <x-forms.input
                    label="Nom"
                    wire="name"
                    required
                    min="2"
                    max="100"
                />

                <div class="form-group mb-3">
                    <x-forms.radio
                        value="unknown"
                        icon="fa-solid fa-question h5"
                        inline
                        checked
                        wire="genre"
                    />
                    <x-forms.radio
                        value="male"
                        icon="fa-solid fa-mars h5"
                        inline
                        wire="genre"
                    />
                    <x-forms.radio
                        value="female"
                        icon="fa-solid fa-venus h5"
                        inline
                        wire="genre"
                    />
                </div>

                <x-forms.input
                    label="Année de naissance"
                    wire="birthdate"
                />

                <div class="row">
                    <x-forms.select
                        classContainer="col-md-6"
                        label="Race"
                        wire="main_breed_id"
                        :options="$breeds"
                        hasEmptyRow
                        required
                    />

                    <x-forms.select
                        classContainer="col-md-6"
                        label="Croisement"
                        wire="second_breed_id"
                        :options="$breeds"
                        hasEmptyRow
                    />
                </div>

                <div class="row">
                    <x-forms.select
                        classContainer="col-md-6"
                        label="Taille"
                        :options='$sizes'
                        wire="size"
                        required
                    />

                    <x-forms.select
                        classContainer="col-md-6"
                        label="Status"
                        :options='$statuses'
                        wire="status"
                        required
                    />
                </div>
            </div>

            <div class="col-12 col-md-5 mb-5">
                <h3 class="mb-3 text--copper">Propriétaire</h3>
                <x-forms.input
                    label="Nom du propriétaire"
                    wire="owner_name"
                    required
                    min="2"
                    max="100"
                />

                <div class="row">
                    <div class="col-md-4">
                        <x-forms.input
                            label="Code postal"
                            wire="owner_zip_code"
                            type="numeric"
                        />
                    </div>
                    
                    <div class="col-md-8">
                        <x-forms.input
                            label="Ville"
                            wire="owner_city"
                        />
                    </div>
                </div>

                <x-forms.input
                        label="Adresse"
                        wire="owner_address"
                    />
            </div>
        </div>

        <div class="row justify-content-between">
            <div class="col-12 col-md-5 mb-5">
                <h3 class="mb-3 text--copper">Contact</h3>
                <x-forms.input
                    label="Numéro de téléphone"
                    wire="owner_phone"
                    required
                    min="6"
                    max="50"
                />

                <x-forms.input
                    label="Numéro alternatif"
                    wire="owner_secondary_phone"
                    type="tel"
                />

                <x-forms.input
                    label="Email"
                    type="email"
                    wire="owner_email"
                />

                <x-forms.checkbox
                    classContainer="mb-3 ps-2"
                    label="Envoyer un message de rappel"
                    wire="owner_has_reminder"
                />
            </div>

            <div class="col-12 col-md-5 mb-5">
                <h3 class="mb-3 text--copper">Informations</h3>

                <x-forms.checkbox
                    classContainer="ps-2"
                    label="Faire attention"
                    wire="has_warning"
                />
                
                <div class="form-group">
                    <label>Durée moyenne</label>
                    <div class="d-flex">
                        <x-forms.input
                            label="Heures"
                            type="number"
                            min="0"
                            wire="hours"
                        />
                        <div class="h4 mx-1">:</div>
                        <x-forms.input
                            label="Minutes"
                            type="number"
                            min="0"
                            max="59"
                            step="5"
                            wire="minutes"
                        />
                    </div>
                </div>

                <x-forms.textarea
                    rows="10"
                    wire="details"
                />
            </div>
        </div>
    </form>
</div>