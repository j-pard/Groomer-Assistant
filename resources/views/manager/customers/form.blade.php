@extends('manager.layouts.app')

@section('content')
    <livewire:customers.header 
        :customer="$customer"
        backUrl="{{ route('customers.index') }}"
    />

    <livewire:customers.form :customer="$customer" />
@endsection
