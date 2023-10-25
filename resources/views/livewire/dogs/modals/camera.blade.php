<div 
    wire:ignore.self class="modal fade"id="cameraModal" tabindex="-1" aria-labelledby="cameraModalLabel" aria-hidden="true"
    x-data
    x-init="$refs.modal.addEventListener('hide.bs.modal', function () { $wire.call('resetMedia') })"
    x-ref="modal"
>
    <div class="modal-dialog">
        <div class="modal-content bg--dark-700 text--light-100">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter un média</h4>
                <button type="button" class="btn-close text--light-200" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <x-forms.file-upload
                    accept=".jpg, .jpeg"
                    wire="uploadedFiles"
                />
            </div>

            @if (count($uploadedFiles) > 0) 
                <div class="row justify-content-center px-2 py-3">
                    @foreach ($uploadedFiles as $file)
                        <div class="col-12 my-1">
                            <img class="img-fluid rounded" src="{{ $file->temporaryUrl() }}">
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-transparent text--light-100 hoverable me-1" data-bs-dismiss="modal">Annuler</button>
                <button role="button" wire:click="addMedia" class="text-white btn btn-primary--copper">Ajouter</button>
            </div>
        </div>
    </div>
</div>