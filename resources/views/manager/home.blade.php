@extends('manager.layouts.app', ['page' => 'home'])

@section('content')
    <h4 class="mb-3">
        Bonjour <span class="text-pink">{{ Auth::user()->name }}</span>, voici tes rendez-vous de la journée.
    </h4>

    <div class="d-flex justify-content-start flex-wrap">
        <div class="custom-card-m card-more border shadow rounded" type="button" data-bs-toggle="modal" data-bs-target="#newRdvModal">
            <div class="more-btn">+</div>
        </div>

        @foreach ($appointments as $appointment)
            <div class="custom-card-m border shadow rounded" data-toggle="modal" data-target="#petModal">
                <div class="text-center">
                    <h5>{{ $appointment->pet->name }}</h5>
                    <p class="text-muted">{{ $appointment->customer->firstname . ' ' . $appointment->customer->lastname }}</p>
                </div>
                <div class="mid">
                    <i class="fas fa-paw"></i>
                </div>
                <div class="tel"><i class="fas fa-phone-alt"></i>
                    {{ $appointment->customer->phone ?? $appointment->customer->secondary_phone }}
                </div>
            </div>
        @endforeach
    </div>
@endsection

@include('manager.partials.modals')