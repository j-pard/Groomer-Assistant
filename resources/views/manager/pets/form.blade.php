@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-light rounded" href="{{ route('pets') }}"><i class="fas fa-arrow-left h4 mr-4 my-auto text-black-50"></i></a>
            @if (isset($pet))
                <h2>{{ $pet->name }}</h2>
            @else
                <h2><span class="text-pink">New</span> pet</h2>
            @endif
        </div>

        @include('manager.partials.session-message')

        <form action="{{ isset($pet) ? route('updatePet') : route('storePet') }}" method="POST">
            @csrf
            @if (isset($pet))
                @method('PUT')
                <input type="hidden" name="petID" value="{{ $pet->uuid }}">
            @endif

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <fieldset>
                                <div class="form-group">
                                    <x-forms.radio
                                        name="genre"
                                        value="unknown"
                                        :selected="isset($pet) && $pet->genre === 'unknown'"
                                        inline
                                    />
                                    <x-forms.radio
                                        name="genre"
                                        value="male"
                                        :selected="isset($pet) && $pet->genre === 'male'"
                                        inline
                                    />
                                    <x-forms.radio
                                        name="genre"
                                        value="female"
                                        :selected="isset($pet) && $pet->genre === 'female'"
                                        inline
                                    />
                                </div>
                                
                                <x-forms.input
                                    :label="'Nom'"
                                    :name="'name'"
                                    :placeholder="'Entrer un nom'"
                                    :value="isset($pet) ? $pet->name : null"
                                    required
                                />

                                <label for="customerInput">Propritéraire</label>
                                <select class="form-control" name="customer" id="customerInput" required>
                                    @if (isset($pet))
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}" {{ $customer->id === $pet->customer_id ? 'selected' : '' }}>{{ $customer->lastname }} {{ $customer->firstname }}</option>
                                        @endforeach
                                    @else
                                        <option value="" selected disabled>Sélectionner un propriétaire</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->lastname }} {{ $customer->firstname }}</option>
                                        @endforeach
                                    @endif
                                </select>
            
                            {{-- TODO: Races --}}
            
                                <x-forms.input
                                    :label="'Anniversaire'"
                                    :type="'date'"
                                    :name="'birthdate'"
                                    :value="isset($pet) ? Carbon\Carbon::parse($pet->birthdate)->format('Y-m-d') : null"
                                    required
                                />

                                <label for="statusInput">Status</label>
                                <select class="form-control" name="status" id="statusInput" required>
                                    @php
                                        foreach ($statusItems as $key => $status) {
                                            if (isset($pet) && $pet->status === $key) {
                                                echo('<option value="' . $key . '" selected>' . $status .'</option>');
                                            } else {
                                                echo('<option value="' . $key . '">' . $status .'</option>');
                                            }
                                        }
                                    @endphp
                                </select>

                                <label>Durée moyenne <span class="text-danger ml-1">*</span></label>
                                <div class="duration-inputs-container">
                                    <x-forms.input
                                        :type="'number'"
                                        :name="'hours'"
                                        :value="isset($pet) ? $duration['hours'] : 0"
                                        :placeholder="00"
                                        :min="0"
                                        required
                                    />
                                    <div class="h4 mx-1">:</div>
                                    <x-forms.input
                                        :type="'number'"
                                        :name="'minutes'"
                                        :value="isset($pet) ? $duration['minutes'] : 0"
                                        :placeholder="00"
                                        :min="0"
                                        :max="59"
                                        required
                                    />
                                </div>
                            </fieldset>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <fieldset>
                                <label for="remarksInput">Remarques</label>
                                <textarea class="form-control" id="remarksInput" name="remarks" rows="12">{{ $pet->remarks ?? '' }}</textarea>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-footer text-end">
                @if (isset($pet))
                    <button type="submit" class="btn btn--primary">Modifier</button>
                @else
                    <button type="submit" class="btn btn--primary">Créer</button>
                @endif
            </div>
        </form>
    </div>

@endsection
