@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-light rounded" href="{{ route('customers') }}"><i class="fas fa-arrow-left h4 mr-4 my-auto text-black-50"></i></a>
            @if (isset($customer))
                <h2>{{ $customer->lastname }} {{ $customer->firstname }}</h2>
            @else
                <h2><span class="text-pink">New</span> customer</h2>
            @endif
        </div>

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
                                    inline
                                />
                                <x-forms.radio
                                    name="genre"
                                    value="male"
                                    :selected="isset($customer) && $customer->genre === 'male'"
                                    inline
                                />
                                <x-forms.radio
                                    name="genre"
                                    value="female"
                                    :selected="isset($customer) && $customer->genre === 'female'"
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
                                <div class="col-3">
                                    <x-forms.input
                                        label="Code postal"
                                        name="zip_code"
                                        placeholder="0000"
                                        :value="isset($customer) ? $customer->zip_code : null"
                                        required
                                    />
                                </div>
    
                                <div class="col-9">
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

                            <h3 class="mt-4 mb-3">Contacts</h3>

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
                            <div class="form-group">
                                <fieldset>
                                    <label for="remarksInput">Remarques</label>
                                    <textarea class="form-control" name="more_info" rows="15">{{ $pet->remarks ?? '' }}</textarea>
                                </fieldset>
                            </div>
                        </div>
                    </div>

                </fieldset>
            </div>
            
            <div class="card-footer text-end">
                @if (isset($customer))
                    <button type="submit" class="btn btn--primary">Modifier</button>
                @else
                    <button type="submit" class="btn btn--primary">Créer</button>
                @endif
            </div>
        </form>
    </div>

@endsection
