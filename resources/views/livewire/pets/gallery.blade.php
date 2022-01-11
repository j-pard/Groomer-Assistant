<div>
    <form wire:submit.prevent="save" autocorrect="off" autocapitalize="off" autocomplete="off">
        <button type="submit" onclick="return false;" style="display:none;"></button>
        
        <div class="card-body">
            <fieldset>
                <div class="row d-flex justify-content-start mb-3">
                    <div class="col-12 col-lg-6">
                        <x-forms.file-upload
                            accept=".jpg, .jpeg"
                            wire="media"
                            wireModifier="defer"
                        />
                    </div>
                </div>

                <div class="row d-flex align-items-center">
                    @foreach ($medias as $_media)
                        <div class="col-12 col-md-5 col-lg-4 col-xl-3 my-1">
                            <img src="{{ $_media }}" class="rounded img-fluid shadow">
                        </div>
                    @endforeach
                </div>
            </fieldset>
        </div>
    </form>
</div>