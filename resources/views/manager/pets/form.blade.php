@extends('manager.layouts.app')

@section('content')

    <livewire:pets.header 
        :pet="$pet"
        backUrl="{{ route('pets.index') }}"
    />

    <livewire:pets.form :pet="$pet" />

@endsection
