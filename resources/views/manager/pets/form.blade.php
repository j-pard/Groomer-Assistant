@extends('manager.layouts.app', ['page' => 'pet'])

@section('content')

    <livewire:pets.header 
    :pet="$pet"
    backUrl="{{ route('pets.index') }}"
    />

    <livewire:pets.form :pet="$pet" />

@endsection
