@extends('manager.layouts.app')

@section('content')
    @if (Route::currentRouteName() == 'pets.appointment')
        <livewire:appointments.header 
        :model="$appointment"
        backUrl="{{ route('pets.edit', ['pet' => $pet]) }}"
    />
    @else
        <livewire:appointments.header 
            :model="$appointment"
            backUrl="{{ isset($customer) ? route('customers.edit', ['customer' => $customer]) : route('customers.index') }}"
        />
    @endif

    <livewire:appointments.form :customer="$customer" :pet="$pet" :appointment="$appointment" />
@endsection
