<div class="modal fade" id="addPetModal" tabindex="-1" aria-labelledby="addPetModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('attachPet') }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPetModalLabel">Selectionner un animal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <small>
                            Sélectionner un chien parmi la liste ci-dessous.
                            La liste est composée exclusivement d'animaux sans collier.
                        </small>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="customerId" value="{{ $customer->id }}">
                        
                        <x-forms.select
                            name="petId"
                            :options='App\Models\Pet::getOrphansList()'
                            required
                        />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success text-light">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>