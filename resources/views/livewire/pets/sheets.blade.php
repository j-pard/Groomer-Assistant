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

                <div class="row d-flex align-items-center">
                    @foreach ($sheets as $_sheet)
                        <div class="col-12 col-md-5 col-lg-4 col-xl-3">
                            <img src="{{ $_sheet }}" class="rounded img-fluid shadow" data-bs-toggle="modal" data-bs-target="#sheet{{ $loop->iteration }}">
                        </div>

                        <div class="modal" tabindex="-1" id="sheet{{ $loop->iteration }}">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <div class="col-12 d-flex justify-content-center">
                                                <img src="{{ $_sheet }}" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </fieldset>
        </div>
    </form>
</div>