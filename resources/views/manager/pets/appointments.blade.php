@extends('manager.layouts.app')

@section('content')
    <livewire:pets.header 
        :pet="$pet"
        backUrl="{{ route('pets.index') }}"
    />

    @include('manager.partials.session-message')

    <livewire:pets.appointments-table :pet="$pet" />
@endsection
