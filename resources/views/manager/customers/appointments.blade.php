@extends('manager.layouts.app', ['page' => 'customer'])

@section('content')
    <livewire:nav.model-header 
        :model="$customer"
        backUrl="{{ route('customers.index') }}"
    />

    @include('manager.partials.session-message')

    <livewire:customers.appointments-table :customer="$customer" />
    
    @if ($customer->exists)
        @include('manager.customers.partials.modals')
    @endif
@endsection
