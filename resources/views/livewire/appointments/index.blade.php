<div>
    <form wire:submit.prevent="save">
        <div class="d-flex justify-content-between align-items-center px-2 mb-3">
            <h4 class="">
                Bonjour <span class="text-pink">{{ Auth::user()->name }}</span>, voici tes rendez-vous de la journée.
            </h4>

            <div class="d-flex justify-content-around align-items-center">
                <button class="btn btn-transparent mb-2" wire:click="previousDay">
                    <i class="fas fa-backward"></i>
                </button>

                <x-forms.datepicker
                    class="my-1"
                    wire="activeDate"
                    wireModifier="lazy"
                />

                <button class="btn btn-transparent mb-2" wire:click="nextDay">
                    <i class="fas fa-forward"></i>
                </button>
            </div>
            
        </div>

        <div class="d-flex justify-content-start flex-wrap">
            <div class="custom-card-m card-more border shadow rounded" type="button" wire:click="loadNewApptModal">
                <div class="more-btn">+</div>
            </div>
    
            @foreach ($appointments as $appointment)
                <div class="custom-card-m border shadow rounded" type="button" wire:click="loadApptModal({{ $appointment->id }})">
                    <div class="text-center">
                        <h5>{{ $appointment->pet->name }}</h5>
                        <p class="text-muted">{{ $appointment->customer->firstname . ' ' . $appointment->customer->lastname }}</p>
                    </div>
                    <div class="mid">
                        @switch($appointment->status)
                            @case('cash')
                            @case('private')
                                <i class="fas fa-euro-sign"></i>
                                @break
                            @case('payconiq')
                                <i class="fas fa-qrcode"></i>
                                @break
                            @case('bank')
                                <i class="fas fa-credit-card"></i>
                                @break
                            @case('voucher')
                                <i class="fas fa-percentage"></i>                            
                                @break
                            @case('not paid')
                                <i class="fas fa-exclamation"></i>
                                @break
                            @case('cancelled')
                                <i class="fas fa-user-alt-slash"></i>
                                @break
                            @default
                                <i class="fas fa-paw"></i>
                        @endswitch
                    </div>
                    <div class="tel"><i class="fas fa-phone-alt"></i>
                        {{ $appointment->customer->phone ?? $appointment->customer->secondary_phone }}
                    </div>
                </div>
            @endforeach
        </div>
    </form>

    @include('livewire.appointments.partials.modal')
</div>