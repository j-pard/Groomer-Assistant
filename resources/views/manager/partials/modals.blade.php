<div class="modal fade" id="newRdvModal" tabindex="-1" aria-labelledby="newRdvModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <form action="">
                @csrf
                <input type="hidden" id="getPetsUrl" value="{{ route('getPetsOptions') }}">

                <div class="modal-header">
                    <h5 class="modal-title" id="newRdvModalLabel">Ajouter un Rendez-vous</h5>
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
                                label="Propriétaire"
                                name="customer"
                                id="customerSelect"
                                :options='App\Models\Customer::getList()'
                                required
                            />

                            <x-forms.select
                                label="Chien"
                                name="pet"
                                id="petSelect"
                                :options='[-1 => "---"]'
                                disabled
                            />
                            
                        </div>
        
                        {{-- RIGHT COLUMN --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <fieldset>
                                    <label for="notes">Notes</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="8"></textarea>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn--primary">Sauver</button>
                </div>
            </form>
        </div>
    </div>
</div>