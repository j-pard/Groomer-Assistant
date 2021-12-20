<div>
    <form wire:submit.prevent="save" autocorrect="off" autocapitalize="off" autocomplete="off">
        <button type="submit" onclick="return false;" style="display:none;"></button>
        
        <div class="card-body">
            <fieldset>
                <div class="row d-flex justify-content-start mb-3">
                    <div class="col-12 col-lg-6">
                        <x-forms.file-upload
                            accept=".jpg, .jpeg"
                            wire="sheet"
                            wireModifier="defer"
                        />
                    </div>
                </div>

                <div class="row d-flex justify-content-around">
                    @foreach ($sheets as $_sheet)
                        <div class="col-12 col-md-5 col-lg-4 col-xl-3">
                            <img src="{{ $_sheet }}" class="rounded img-fluid">
                        </div>
                    @endforeach
                </div>
            </fieldset>
        </div>
    </form>
</div>
