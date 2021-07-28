@extends('manager.layouts.app', ['page' => 'customer'])

@section('content')
    <header>
        <div class="d-flex justify-content-between align-items-center">
            <a class="btn btn-transparent circle" href="{{ route('customers.index') }}"><i class="fas fa-arrow-left h4 my-auto text-black-50"></i></a>
            @if (isset($customer->id))
                <h2 class="mb-0 text-nowrap">{{ $customer->lastname }} {{ $customer->firstname }}</h2>
            @endif
        </div>

        <ul class="nav nav-pills d-flex justify-content-end align-items-center" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-form-tab" data-bs-toggle="pill" data-bs-target="#pills-form" type="button" role="tab" aria-controls="pills-form" aria-selected="true">Détails</button>
            </li>
            @if (isset($customer->id))
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-dates-tab" data-bs-toggle="pill" data-bs-target="#pills-dates" type="button" role="tab" aria-controls="pills-dates" aria-selected="false">Rendez-vous</button>
                </li>

                <li class="nav-item">
                    <div class="dropdown d-flex align-items-center">
                        <i class="fas fa-cog text-secondary h4 m-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false"></i>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li>
                                <a class="dropdown-item" role="button" data-bs-toggle="modal" data-bs-target="#customerApptModal">
                                    <i class="fas fa-calendar-plus text-secondary me-3"></i>Nouveau RDV
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item js-confirm-delete" role="button" data-customer-id="{{ $customer->id }}">
                                    <i class="fas fa-trash text-secondary me-3"></i>Supprimer
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
        </ul>
    </header>

    @include('manager.partials.session-message')

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-form" role="tabpanel" aria-labelledby="pills-form-tab">
            <livewire:customers.form :customer="$customer" />
        </div>

        @if (isset($customer->id))
            <div class="tab-pane fade" id="pills-dates" role="tabpanel" aria-labelledby="pills-dates-tab">
                <div class="card-body">
                    <livewire:customers.appointments-table :customer="$customer" />
                </div>
            </div>
        @endif
    </div>

    @if (isset($customer->id))
        {{-- @include('manager.customers.partials.modals') --}}
    @endif
@endsection
