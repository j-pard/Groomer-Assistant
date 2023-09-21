<div>
    <div class="list-heading">
        <div class="input-group searchbar px-3 px-md-2">
            <input type="text" wire:model.live.debounce.500ms="search" class="form-control mb-0 search-input" placeholder="Akinator n'a qu'à bien se tenir ...">
            <span class="input-group-text">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <span class="input-group-text clearable" wire:click="clearSearch">
                <i class="fa-solid fa-xmark"></i>
            </span>
        </div>
    </div>

    <div class="d-flex flex-column pt-3 pb-1 mb-1">
        @foreach ($dogs as $dog)
            <div class="list-element mx-2 my-1 py-2 px-1 px-sm-3" data-id="{{ $dog->id }}">
                <div class="d-flex flex-row">
                    <div class="d-flex flex-row align-items-center">
                        <div class="avatar mx-2 mx-sm-4">{{ $dog->avatar }}</div>
                    </div>
                    <div class="d-flex flex-column">
                        <div>{{ $dog->name }}</div>
                        <span class="text--quartz">{{ $dog->owner_name }}</span>
                        <em class="text--quartz">{{ $dog->owner_phone }}</em>
                    </div>
                </div>
                <div class="d-flex flex-column text-end justify-content-between">
                    <div>{{ $dog->mainBreed->breed }}</div>
                    <div class="d-flex justify-content-end flex-no-wrap">
                        @if ($dog->second_breed_id !== null)
                            <span class="badge rounded-pill bg--quartz me-2">Croisé</span>
                        @endif
                        <span class="badge rounded-pill {{ 'bg-' . App\Enums\DogStatus::getColor($dog->status) }}">{{ App\Enums\DogStatus::getText($dog->status) }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mb-5 pb-5 px-2">
        {{ $dogs->links() }}
    </div>
</div>
