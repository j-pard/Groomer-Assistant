@extends('manager.layouts.app', ['page' => 'customer'])

@section('content')
    <livewire:customers.header 
        :customer="$customer"
        backUrl="{{ route('customers.index') }}"
    />

    @include('manager.partials.session-message')

    <livewire:customers.appointments-table :customer="$customer" />
@endsection
