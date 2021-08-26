@extends('manager.layouts.app')

@section('content')
    <livewire:appointments.header 
        :model="$appointment"
        backUrl="{{ isset($customer) ? route('customers.edit', ['customer' => $customer]) : route('customers.index') }}"
    />

    <livewire:appointments.form :customer="$customer" :appointment="$appointment" />
@endsection
