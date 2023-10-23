<div>
    <h5 class="mb-4">Pour quel chien veux-tu un nouveau rendez-vous ?</h5>
    <x-forms.input
        label="Nom du chien ou du propriétaire"
        wire="search"
        required
        min="2"
        max="100"
    />

    <div class="d-flex flex-column pt-3 pb-1 mb-1" wire:loading.class="opacity-50">
        @if ($dogs !== null)
            <div class="mb-3">
                @forelse ($dogs as $dog)
                    <div class="list-element justify-content-start align-items-center mx-2 my-2 p-2">
                        <x-forms.radio
                            wire="selectedDog"
                            :value="$dog->id"
                        />
                        <div class="d-flex flex-row col-md-5">
                            <div class="d-flex flex-column">
                                <div>
                                    @switch($dog->genre)
                                        @case('male')
                                            <i class="fa-solid fa-mars text--copper me-1"></i>
                                            @break
                                        @case('female')
                                            <i class="fa-solid fa-venus text--copper me-1"></i>
                                            @break
                                        @default
                                            <i class="fa-solid fa-question text--copper me-1"></i>
                                    @endswitch
                                    {{ $dog->name }}
                                </div>
                                <div>
                                    <span class="text--quartz">{{ $dog->owner->name }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-column text-end justify-content-between ms-auto col-md-4">
                            <div>{{ $dog->mainBreed->breed }}</div>
                            <div class="d-flex justify-content-end flex-no-wrap">
                                @if ($dog->second_breed_id !== null)
                                    <span class="badge rounded-pill bg--quartz me-2">Croisé</span>
                                @endif
                                <span class="badge rounded-pill {{ 'bg-' . App\Enums\DogStatus::getColor($dog->status) }}">{{ App\Enums\DogStatus::getText($dog->status) }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    @if (strlen($search) >= 2)
                        <div>
                            Il n'y a pas de chien connu avec ce nom.
                        </div>
                    @endif
                @endforelse
            </div>
        @endif
    </div>
</div>