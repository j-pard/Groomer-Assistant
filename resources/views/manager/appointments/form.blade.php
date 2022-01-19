@extends('manager.layouts.app')

@section('content')
    <livewire:appointments.header 
        :model="$appointment"
        backUrl="{{ url()->previous() }}"
    />

    <livewire:appointments.form :customer="$customer" :pet="$pet" :appointment="$appointment" />
@endsection
