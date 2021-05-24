{{-- Edit --}}
<div class="modal fade" id="apptModal" tabindex="-1" aria-labelledby="apptModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <form action="{{ route('updateAppointment') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="d-none">
                    <input type="hidden" name="id" value="">
                </div>
                <div class="modal-header">
                    <h5 class="modal-title" id="apptModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {{-- LEFT COLUMN --}}
                        <div class="col-md-6">
                            <div class="row">
                                <div class="form-group col-6">
                                    <x-forms.input
                                        label="Date"
                                        name="date"
                                        type="date"
                                        required
                                    />
                                </div>
                                <div class="form-group col-6">
                                    <x-forms.input
                                        label="Heure"
                                        name="time"
                                        type="time"
                                        required
                                    />
                                </div>
                            </div>

                            <x-forms.select
                                label="Status"
                                name="status"
                                :options='App\Models\Appointment::getStatusAsOptions()'
                                required
                            />
                            
                        </div>
        
                        {{-- RIGHT COLUMN --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <fieldset>
                                    <label for="notes">Notes</label>
                                    <textarea class="form-control" name="notes" rows="8"></textarea>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn--primary">Sauver</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Add Pet Modal --}}
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-success text-light">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Detach Pet Modal --}}
<div class="modal fade" id="detachPetModal" tabindex="-1" aria-labelledby="detachPetModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('detachPet') }}" method="post">
                @csrf
                <input type="hidden" name="customerId" value="{{ $customer->id }}">
                <input type="hidden" name="petId" value="">

                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white" id="detachPetModalLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        Enlever le lien entre le chien et son propriétaire ?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger text-light">Confirmer</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Delete Customer Modal --}}
<div class="modal fade" id="deleteCustomerModal" tabindex="-1" aria-labelledby="deleteCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('deleteCustomer') }}" method="post">
                @csrf
                @method('DELETE')
                <input type="hidden" name="customerId" value="">

                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white" id="deleteCustomerModalLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        Supprimer définitevement le client ?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger text-light">Supprimer</button>
                </div>
            </form>
        </div>
    </div>
</div>