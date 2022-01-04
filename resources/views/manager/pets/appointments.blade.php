@extends('manager.layouts.app')

@section('content')
    <livewire:pets.header 
        :pet="$pet"
        backUrl="{{ route('pets.index') }}"
    />

    {{-- <livewire:pets.appointments-table :pet="$pet" /> --}}
@endsection
