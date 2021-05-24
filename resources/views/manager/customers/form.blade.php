@extends('manager.layouts.app', ['page' => 'customer'])

@section('content')
    <header>
        <div class="d-flex justify-content-between align-items-center">
            <a class="btn btn-transparent circle" href="{{ route('customers') }}"><i class="fas fa-arrow-left h4 my-auto text-black-50"></i></a>
            @if (isset($customer))
                <h2 class="mb-0 text-nowrap">{{ $customer->lastname }} {{ $customer->firstname }}</h2>
            @endif
        </div>

        <ul class="nav nav-pills d-flex justify-content-end align-items-center" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-form-tab" data-bs-toggle="pill" data-bs-target="#pills-form" type="button" role="tab" aria-controls="pills-form" aria-selected="true">Détails</button>
            </li>
            @if (isset($customer))
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-dates-tab" data-bs-toggle="pill" data-bs-target="#pills-dates" type="button" role="tab" aria-controls="pills-dates" aria-selected="false">Rendez-vous</button>
                </li>

                <li class="nav-item">
                    <div class="dropdown d-flex align-items-center">
                        <i class="fas fa-cog text-secondary h4 m-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false"></i>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
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
            <form action="{{ isset($customer) ? route('updateCustomer') : route('storeCustomer') }}" method="POST">
                @csrf
                @if (isset($customer))
                    @method('PUT')
                    <input type="hidden" name="customerID" value="{{ $customer->uuid }}">
                @endif

                <div class="card-body">
                    <fieldset>
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="mb-3">Informations</h3>

                                <div class="form-group">
                                    <x-forms.radio
                                        name="genre"
                                        value="unknown"
                                        :selected="!isset($customer) || $customer->genre === 'unknown'"
                                        :isIcon="true"
                                        label="far fa-question-circle"
                                        inline
                                    />
                                    <x-forms.radio
                                        name="genre"
                                        value="male"
                                        :selected="isset($customer) && $customer->genre === 'male'"
                                        :isIcon="true"
                                        label="fas fa-mars"
                                        inline
                                    />
                                    <x-forms.radio
                                        name="genre"
                                        value="female"
                                        :selected="isset($customer) && $customer->genre === 'female'"
                                        :isIcon="true"
                                        label="fas fa-venus"
                                        inline
                                    />
                                </div>

                                <x-forms.input
                                    label="Nom"
                                    name="lastname"
                                    placeholder="Entrer le nom de famille"
                                    :value="isset($customer) ? $customer->lastname : null"
                                    required
                                />

                                <x-forms.input
                                    label="Prénom"
                                    name="firstname"
                                    placeholder="Entrer le prénom"
                                    :value="isset($customer) ? $customer->firstname : null"
                                    required
                                />

                                <div class="row">
                                    <div class="col-md-4">
                                        <x-forms.input
                                            label="Code postal"
                                            name="zip_code"
                                            placeholder="0000"
                                            :value="isset($customer) ? $customer->zip_code : null"
                                            required
                                        />
                                    </div>

                                    <div class="col-md-8">
                                        <x-forms.input
                                            label="Ville"
                                            name="city"
                                            placeholder="Entrer le nom de la ville"
                                            :value="isset($customer) ? $customer->city : null"
                                            required
                                        />
                                    </div>
                                </div>

                                <x-forms.input
                                    label="Adresse"
                                    name="address"
                                    placeholder="Entrer l'adresse"
                                    :value="isset($customer) ? $customer->address : null"
                                />

                                <h3 class="mt-4 mb-3">Contact</h3>

                                <x-forms.input
                                    label="Email"
                                    type="email"
                                    name="email"
                                    placeholder="Entrer l'adresse email"
                                    :value="isset($customer) ? $customer->email : null"
                                />

                                <x-forms.input
                                    label="Numéro de téléphone"
                                    name="phone"
                                    placeholder="Entrer le numéro"
                                    :value="isset($customer) ? $customer->phone : null"
                                />

                                <x-forms.input
                                    label="Numéro alternatif"
                                    name="secondary_phone"
                                    placeholder="Entrer le numéro alternatif"
                                    :value="isset($customer) ? $customer->secondary_phone : null"
                                />
                            </div>

                            <div class="col-md-6">

                                <h3 class="mb-3">Détails</h3>
                                <div class="form-group">
                                    <fieldset>
                                        <label for="remarksInput">Remarques</label>
                                        <textarea class="form-control" name="more_info" rows="10">{{ $customer->more_info ?? '' }}</textarea>
                                    </fieldset>
                                </div>

                                @if (isset($customer))
                                    <h3 class="mt-4 mb-3">
                                        Animaux
                                        <a href="#" type="button" class="mx-3" title="Ajouter" data-bs-toggle="modal" data-bs-target="#addPetModal">
                                            <i class="fas fa-plus-circle text-success"></i>
                                        </a>
                                    </h3>
                                    <div class="form-group">
                                        <ul class="list-group list-unstyled">
                                            @forelse ($customer->pets->sortBy('name') as $pet)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <a class="list-group-item-action text-decoration-none p-2 mr-3" href="{{ route('editPet', ['pet' => $pet]) }}">
                                                            <i class="fas fa-external-link-alt"></i>
                                                        </a>
                                                        <span>{{ $pet->name }}</span>
                                                    </div>
                                                    <button type="button" class="btn btn-transparent js-confirm-detach" data-pet-id="{{ $pet->id }}">
                                                        <i class="fas fa-times text-danger h5"></i>
                                                    </button>
                                                </li>
                                            @empty
                                                
                                            @endforelse
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </fieldset>
                </div>
                
                <div class="form-actions-buttons">
                    <button type="submit" class="btn btn--primary btn-circle">
                        <i class="far fa-save"></i>
                    </button>
                </div>
            </form>
        </div>

        @if (isset($customer))
            <div class="tab-pane fade" id="pills-dates" role="tabpanel" aria-labelledby="pills-dates-tab">
                <div class="card-body">
                    <livewire:customer-appointments-table :customer="$customer" />
                </div>
            </div>
        @endif
    </div>

    @if (isset($customer))
        @include('manager.customers.partials.modals')
    @endif
@endsection
