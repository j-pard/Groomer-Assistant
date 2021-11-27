@extends('manager.layouts.app')

@section('content')
    <livewire:customers.header 
        :customer="$customer"
        backUrl="{{ route('customers.index') }}"
    />

    <livewire:customers.appointments-table :customer="$customer" />
@endsection
