<div>
    <div class="d-flex justify-content-between align-items-center">
        <div class="px-3 px-md-2 datebar">
            <x-forms.input
                label="Rendez-vous du jour"
                type="date"
                wire="date"
                required
                classContainer="mb-0"
            />
        </div>

        <div class="d-flex justify-content-center align-items-center me-4 mt-2">
            <a wire:click="loadCreateApptModal()">
                <i class="fa-solid fa-plus h3 text--quartz hoverable"></i>
            </a>
        </div>
    </div>

    <div class="d-flex flex-column pt-3 pb-1 mb-1" wire:loading.class="opacity-50">
        @php
            // Define times to display separation between times
            $currentTime = 0;
            $previousTime = 0;
        @endphp

        @foreach ($appointments as $appointment)
            @php
                $currentTime = Carbon\Carbon::parse($appointment->time)->format('H:i');
                $dog = $appointment->dog;
            @endphp

            @if ($loop->first || ($currentTime !== $previousTime))
                <div class="text--quartz p-1 ms-2 mb-1 h5 {{ !$loop->first ? 'mt-4' : '' }}">{{ $currentTime }}</div>
            @endif

            <div class="list-element mx-2 my-1 py-2 px-1 px-sm-3" data-id="{{ $appointment->id }}">
                <div class="d-flex flex-row col-md-5">
                    <div class="d-flex flex-row align-items-center">
                        <div class="avatar mx-2 mx-sm-4">
                            <a wire:click="loadApptModal({{ $appointment->id }})">{{ $dog->avatar }}</a>
                        </div>
                    </div>
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
                        <span class="text--quartz">
                            {{ $dog->owner->name }}
                            @if ($dog->owner->has_reminder)
                                <span class="badge rounded-pill bg--copper ms-1"><i class="fa-solid fa-envelope"></i></span>
                            @endif
                            @if (!empty($dog->details))
                                <i class="fa-solid fa-comment ms-1"></i>
                        @endif
                        </span>
                        <em class="text--quartz cell-mobile">{{ $dog->owner->phone }}</em>
                    </div>
                </div>

                <div class="cell-desktop col-md-3">
                    <div class="d-flex flex-column">
                        <div class="text--quartz"><i class="fa-solid fa-phone text--copper me-2"></i>{{ $dog->owner->phone }}</div>
                        <div class="text--quartz"><i class="fa-solid fa-dog text--copper me-2"></i>{{ $dog->mainBreed->breed . ($dog->second_breed_id !== null ? '  /  ' . $dog->secondBreed->breed : '') }}</div>
                    </div>
                </div>

                <div class="d-flex flex-column text-end justify-content-between col-md-4">
                    <div class="cell-mobile">
                        <div><em class="text--quartz cell-mobile">{{ $dog->mainBreed->breed }}</em></div>
                    </div>

                    <div class="d-flex justify-content-end flex-no-wrap">
                        @if ($dog->has_warning)
                            <span class="badge rounded-pill bg-danger me-2"><i class="fa-solid fa-triangle-exclamation"></i></span>
                        @endif
                        @if (!empty($appointment->notes))
                            <i class="fa-solid fa-note-sticky me-2"></i>
                        @endif
                        <span class="badge rounded-pill {{ 'bg-' . App\Enums\AppointmentStatus::getColor($appointment->status) }}">{{ App\Enums\AppointmentStatus::getText($appointment->status) }}</span>
                    </div>
                    <div>{{ $appointment->getPriceAsString() }}</div>
                </div>
            </div>

            @php
                $previousTime = $currentTime;
            @endphp
        @endforeach
    </div>

    @include('livewire.appts.modals.create')
    @include('livewire.appts.modals.show')
</div>
