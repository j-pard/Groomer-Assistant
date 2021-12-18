<div>
    <form wire:submit.prevent="save">
        <div class="card-body">
            <fieldset>
                <div class="row">
                    <div class="col-md-6">
                        <x-forms.file-upload
                            accept=".jpg, .jpeg"
                            wire="sheet"
                        />
                    </div>
                </div>
            </fieldset>
        </div>
        
        <div class="form-actions-buttons">
            <x-buttons.save />
        </div>
    </form>
</div>
