@extends('manager.layouts.app', ['page' => 'home'])

@section('content')
    <div class="d-flex justify-content-between px-2">
        <h4 class="mb-3">
            Bonjour <span class="text-pink">{{ Auth::user()->name }}</span>, voici tes rendez-vous de la journée.
        </h4>
        <button type="button" class="btn btn-transparent" data-bs-toggle="modal" data-bs-target="#calendarModal">
            <span>{{ $day }}</span>
            <i class="far fa-calendar-alt h4"></i>
        </button>          
    </div>

    <div class="d-flex justify-content-start flex-wrap">
        <div class="custom-card-m card-more border shadow rounded" type="button" data-bs-toggle="modal" data-bs-target="#newRdvModal">
            <div class="more-btn">+</div>
        </div>

        @foreach ($appointments as $appointment)
            <div class="custom-card-m border shadow rounded js-pet-modal">
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
                <input type="hidden" class="d-none js-values" value="{{ json_encode($appointment->getAttributes() + [
                    'date' =>  Carbon\Carbon::parse($appointment->time)->format('Y-m-d'),
                    'hours' => Carbon\Carbon::parse($appointment->time)->format('H:i'),
                    'customer' => $appointment->customer->firstname . ' ' . $appointment->customer->lastname,
                    'pet' => $appointment->pet->name,
                ]) }}">
            </div>
        @endforeach
    </div>
@endsection