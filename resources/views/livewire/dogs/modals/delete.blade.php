<div 
    wire:ignore.self class="modal fade" id="deleteDogModal" tabindex="-1" aria-labelledby="deleteDogModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg--dark-700 text--light-100">
            <form method="POST" action="{{ route('dogs.delete') }}">
                @csrf
                <input type="hidden" name="dog_id" value="{{ $dog->id }}">

                <div class="modal-header">
                    <h5 class="modal-title">Supprimer le chien ?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <p>
                                <strong>
                                    Le chien sera supprimé définitivement.
                                    Tu confirmes ?
                                </strong>
                            </p>

                            @if (!$ownerHasMoreDogs)
                                <x-forms.checkbox
                                    label="Le propriétaire n'a plus d'autre chien. Veux-tu le supprimer également ?"
                                    wire="isDeletingOwner"
                                    name="delete_owner"
                                />
                            @endif
                        </div>
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-transparent text--light-100 me-1" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger text--light-100">Supprimer</button>
                </div>
            </form>
        </div>
    </div>
</div>