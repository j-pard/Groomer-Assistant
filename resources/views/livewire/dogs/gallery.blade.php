<div>
    <div class="d-flex justify-content-between align-items-center">
        <div class="mx-2 mt-1 py-2">
            <h3>{{ $dog->name }}<span class="text--quartz"> - {{ $dog->owner->name }}</span></h3>
        </div>

        <div class="d-flex justify-content-center align-items-center me-4 mt-2">
            <a wire:click="loadCameraModal()">
                <i class="fa-solid fa-camera h3 text--quartz hoverable"></i>
            </a>
        </div>
    </div>

    <!-- Gallery -->
    <div class="row pt-3 pb-1 mb-1 px-2" wire:loading.class="opacity-50">
        @forelse ($medias->sortByDesc('created_at') as $media)
            @if ($loop->odd)
                <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
            @endif

                <div class="overlay-images mb-4" x-data="{ open: false }">
                    <img src="{{ $media->getUrl() }}" class="w-100 shadow-1-strong rounded" x-on:click="open = ! open">
                    <div class="overlay" x-show="open" x-transition>
                        <div class="d-flex justify-content-around align-items-center h-100">
                            <button type="button" class="btn btn-icon text--quartz hoverable" wire:click="deleteMedia('{{ $media->id }}')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>

            @if ($loop->even)
                </div>
            @endif
        @empty
            <div class="p-3 text-center">
                <p>Tu n'as pas encore ajouté de photo dans cette gallerie.</p>
            </div>
        @endforelse
    </div>
    <!-- Gallery -->

    @include('livewire.dogs.modals.camera')
</div>
