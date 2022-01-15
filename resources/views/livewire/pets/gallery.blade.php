<div
    x-data=""
    x-on:livewire-upload-finish="@this.save()"
>
    <form wire:submit.prevent="save" autocorrect="off" autocapitalize="off" autocomplete="off">
        <button type="submit" onclick="return false;" style="display:none;"></button>
        
        <div class="card-body">
            <fieldset>
                <div class="row d-flex justify-content-start mb-3">
                    <div class="col-12 col-lg-6">
                        <x-forms.file-upload
                            accept=".jpg, .jpeg"
                            wire="uploadedFiles"
                            wireModifier="lazy"
                        />
                    </div>
                </div>

                <div class="row d-flex align-items-center">
                    @foreach ($medias as $_name => $_url)
                        <div class="overlay-images col-12 col-md-5 col-lg-4 col-xl-3 my-1 p-0">
                            <img src="{{ $_url }}" class="rounded img-fluid shadow">
                            <div class="overlay overlay--hide">
                                <button type="button" class="btn btn-icon text-danger" wire:click="deleteMedia('{{$_name}}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </fieldset>
        </div>
    </form>
</div>