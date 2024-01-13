<div>
    <div class="row">
        <div class="col-6">
            <x-forms.input
                label="Date"
                type="date"
                wire="apptDate"
                required
                lazy
            />
        </div>
        <div class="col-6">
            <x-forms.input
                label="Heure"
                type="time"
                wire="apptTime"
                required
                lazy
            />
        </div>
    </div>

    <div class="row">
        <x-forms.input
            label="Nom du chien"
            wire="dogName"
            disabled
            required
            lazy
        />

        <x-forms.input
            label="Propriétaire"
            wire="ownerName"
            disabled
            required
            lazy
        />
    </div>

    <div class="row mb-4">
        <x-forms.textarea
            label="Notes"
            rows="10"
            wire="apptNotes"
            lazy
        />
    </div>
</div>