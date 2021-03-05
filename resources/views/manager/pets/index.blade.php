@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h2><span class="text-pink">P</span>ets</h2>
            <a href="{{ route('newPet') }}" class="btn btn--primary">Nouveau</a>
        </div>
        <div class="card-body">
            <livewire:pets-table />
        </div>
    </div>

@endsection
