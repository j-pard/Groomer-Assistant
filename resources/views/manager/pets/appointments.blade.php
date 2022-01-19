@extends('manager.layouts.app')

@section('content')
    <div class="mb-2">
        <livewire:pets.header 
            :pet="$pet"
            backUrl="{{ route('pets.edit', ['pet' => $pet]) }}"
        />
    </div>

    <div class="table-container">
        <livewire:pets.appointments-table :pet="$pet" />
    </div>
@endsection
