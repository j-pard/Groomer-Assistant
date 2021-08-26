@extends('manager.layouts.app')

@section('content')
    <livewire:customers.header 
        :customer="$customer"
        backUrl="{{ route('customers.index') }}"
    />

    @include('manager.partials.session-message')

    <livewire:customers.form :customer="$customer" />
@endsection
