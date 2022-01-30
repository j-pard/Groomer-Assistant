<div>
    <form wire:submit.prevent="save">
        <div class="row">
            <div id="calendar-input" class="d-flex align-items-center">
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

        <div class="row justify-content-center justify-content-md-start">
            <div class="col-5 col-md-4 col-lg-3 col-xl-2 custom-card-m card-more border shadow rounded" type="button" wire:click="loadNewApptModal">
                <div class="more-btn">+</div>
            </div>

            @foreach ($appointments as $appointment)
                <div class="col-5 col-md-4 col-lg-3 col-xl-2 custom-card-m border shadow rounded" type="button" wire:click="loadApptModal({{ $appointment->id }})">
                    <div class="text-center">
                        <h5>{!! $appointment->pet->getName() !!}</h5>
                        <p class="text-muted">{{ $appointment->customer->firstname . ' ' . $appointment->customer->lastname }}</p>
                    </div>
                    <div class="mid">
                        @switch($appointment->status)
                            @case('cash')
                                <i class="fas fa-euro-sign"></i>
                                @break
                            @case('private')
                                <i class="fab fa-product-hunt"></i>
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
                    <div class="row">
                        <span class="text-muted">{{ Carbon\Carbon::parse($appointment->time)->format('H:i') }}</span>
                    </div>
                    <div class="tel d-flex justify-content-between align-items-center">
                        <i class="fas fa-phone-alt me-2"></i>
                        <span>{{ $appointment->customer->phone ?? $appointment->customer->secondary_phone }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </form>

    @include('livewire.appointments.partials.modal')
</div>