{{-- Add Pet Modal --}}
<div class="modal fade" id="addPetModal" tabindex="-1" aria-labelledby="addPetModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form wire:submit.prevent="attachPet">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPetModalLabel">Attacher un chien à ce client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        Sélectionner un chien parmi la liste ci-dessous.
                        La liste est composée exclusivement de chiens sans collier.
                    </div>
                    <div class="mb-3">                        
                        <x-forms.select
                            wire="newPetId"
                            :options="$orphans"
                            required
                        />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-success text-light">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>