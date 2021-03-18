@extends('layouts.app')

@section('content')
    <header>
        <div class="d-flex">
            <a class="btn btn-transparent circle" href="{{ route('customers') }}"><i class="fas fa-arrow-left h4 my-auto text-black-50"></i></a>
            @if (isset($pet))
            <h2 class="mb-0">{{ $customer->lastname }} {{ $customer->firstname }}</h2>
            @else
            <h2 class="mb-0"><span class="text-pink">New</span> customer</h2>
            @endif
        </div>
    </header>

    @include('manager.partials.session-message')

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
                                :selected="isset($customer) && $customer->genre === 'unknown'"
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
                                        <li class="list-group-item">
                                            <a class="list-group-item-action text-decoration-none p-2 mr-3" href="{{ route('editPet', ['pet' => $pet]) }}">
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                            <span>{{ $pet->name }}</span>
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


    @include('manager.customers.partials.modals')
@endsection
