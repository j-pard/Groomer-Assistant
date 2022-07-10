<div>
    <form wire:submit.prevent="save" autocorrect="off" autocapitalize="off" autocomplete="off">
        <button type="submit" onclick="return false;" style="display:none;"></button>
        <div class="card-body">
            <fieldset>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-6">
                                <x-forms.datepicker
                                    label="Date"
                                    wire="date"
                                    required
                                />
                            </div>
                            <div class="col-6">
                                <x-forms.input
                                    label="Heure"
                                    type="time"
                                    wire="time"
                                    required
                                />
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Propriétaire</label>
                            <input class="form-control" type="text" value="{{ $customer->getFullName() }}" disabled>
                        </div>

                        <x-forms.select
                            label="Chien"
                            wire="appointment.pet_id"
                            :options="$pets"
                            required
                        />

                        <x-forms.textarea
                            label="Notes"
                            rows="8"
                            wire="appointment.notes"
                        />

                        <div class="row">
                            <div class="col-6">
                                <x-forms.select
                                    label="Status"
                                    wire="appointment.status"
                                    :options='$status'
                                    required
                                />
                            </div>

                            <div class="col-6">
                                <x-forms.price
                                    label="Prix"
                                    wire="appointment.price"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
        
        <div class="form-actions-buttons">
            <x-buttons.save />
        </div>
    </form>
</div>