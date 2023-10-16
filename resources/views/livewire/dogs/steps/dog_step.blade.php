<div>
    <h4 class="mb-3">Avant de créer un nouveau chien, vérifions si il n'existe pas déjà ?</h4>
    <x-forms.input
        label="Nom du chien"
        wire="name"
        required
        min="2"
        max="100"
    />

    <div class="d-flex flex-column pt-3 pb-1 mb-1" wire:loading.class="opacity-50">
        @if ($existingDogs !== null)
            <div class="mb-3">
                @if ($existingDogs->count() > 0)
                    <p>Voici le(s) chien(s) trouvé(s):</p>
                @endif

                @forelse ($existingDogs as $existingDog)
                    <div class="list-element justify-content-start mx-2 my-2 p-2">
                        <div class="d-flex flex-row col-md-5">
                            <div class="d-flex flex-row align-items-center">
                                <div class="avatar mx-2 mx-sm-4">
                                    <a href="{{ route('dogs.show', ['dog' => $existingDog->id]) }}" target="blank">{{ $existingDog->avatar }}</a>
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <div>
                                    @switch($existingDog->genre)
                                        @case('male')
                                            <i class="fa-solid fa-mars text--copper me-1"></i>
                                            @break
                                        @case('female')
                                            <i class="fa-solid fa-venus text--copper me-1"></i>
                                            @break
                                        @default
                                            <i class="fa-solid fa-question text--copper me-1"></i>
                                    @endswitch
                                    {{ $existingDog->name }}
                                </div>
                                <div>
                                    <span class="text--quartz">{{ $existingDog->owner->name }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-column text-end justify-content-between ms-auto col-md-4">
                            <div>{{ $existingDog->mainBreed->breed }}</div>
                            <div class="d-flex justify-content-end flex-no-wrap">
                                @if ($existingDog->second_breed_id !== null)
                                    <span class="badge rounded-pill bg--quartz me-2">Croisé</span>
                                @endif
                                <span class="badge rounded-pill {{ 'bg-' . App\Enums\DogStatus::getColor($existingDog->status) }}">{{ App\Enums\DogStatus::getText($existingDog->status) }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div>
                        Pas de chien connu avec ce nom.
                    </div>
                @endforelse
            </div>
        @endif

        @if (strlen($name) >= 2)
            <div class="row">
                <div class="col">
                    <button role="button" wire:click="nextStep('owner')" class="text-white btn btn-primary--copper px-3">
                        Continuer
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>