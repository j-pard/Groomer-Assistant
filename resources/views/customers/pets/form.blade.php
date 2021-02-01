@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            @if (isset($pet))
                <h2>{{ $pet->name }}</h2>
            @else
                <h2><span class="text-pink">New</span> pet</h2>
            @endif
        </div>

        @include('partials.session-message')

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
                            <label for="nameInput">Nom</label>
                            <input type="text" class="form-control" id="nameInput" name="name" required value="{{ $pet->name ?? '' }}">
                        </div>
        
                        <div class="form-group">
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
                        </div>
        
                        {{-- TODO: Races --}}
        
                        <div class="form-group">
                            <label for="birthdateInput">Anniversaire</label>
                            <input type="date" class="form-control" id="birthdateInput" name="birthdate" value="{{ isset($pet) ? Carbon\Carbon::parse($pet->birthdate)->format('Y-m-d') : '' }}" required>
                        </div>

                        <div class="form-group">
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
                        </div>
        
                        <div class="form-group">
                            <label for="durationInput">Durée moyenne</label>
                            <div class="duration-inputs-container">
                                <input type="number" class="form-control" id="hourInput" name="hours" min="0" placeholder="00" value="{{ $duration['hours'] ?? '' }}">
                                <span class="h4 mx-1">:</span>
                                <input type="number" class="form-control" id="minuteInput" name="minutes" min="0" max="59" placeholder="00" value="{{ $duration['minutes'] ?? '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="remarksInput">Remarques</label>
                            <textarea class="form-control" id="remarksInput" name="remarks" rows="12">{{ $pet->remarks ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-footer">
                @if (isset($pet))
                    <button type="submit" class="btn btn-primary">Modifier</button>
                @else
                    <button type="submit" class="btn btn-primary">Créer</button>
                @endif
            </div>
        </form>
    </div>

@endsection
