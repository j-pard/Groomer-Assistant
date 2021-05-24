{{-- Create --}}
<div class="modal fade" id="newRdvModal" tabindex="-1" aria-labelledby="newRdvModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <form action="{{ route('storeAppointment') }}" method="POST">
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
                                        :value="Carbon\Carbon::now()->format('Y-m-d')"
                                        required
                                    />
                                </div>
                                <div class="form-group col-6">
                                    <x-forms.input
                                        label="Heure"
                                        name="time"
                                        type="time"
                                        value="09:30"
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
                    <button type="submit" class="btn btn--primary">Sauver</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit --}}
<div class="modal fade" id="petModal" tabindex="-1" aria-labelledby="petModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <form action="{{ route('updateAppointment') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="d-none">
                    <input type="hidden" name="id" value="">
                </div>
                <div class="modal-header">
                    <h5 class="modal-title" id="petModalLabel">Détails</h5>
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
        
                            <x-forms.input
                                label="Propriétaire"
                                name="customerName"
                                type="text"
                                disabled
                            />
    
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

{{-- Date picker --}}
<div class="modal fade" id="calendarModal" tabindex="-1" aria-labelledby="calendarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <form action="{{ route('updateAppointment') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="calendarModalLabel">Calendrier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn--primary">Voir</button>
                </div>
            </form>
        </div>
    </div>
</div>