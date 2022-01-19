@extends('manager.layouts.app')

@section('content')
    <div class="mb-2">
        <livewire:customers.header 
            :customer="$customer"
            backUrl="{{ route('customers.edit', ['customer' => $customer]) }}"
        />
    </div>

    <div class="table-container">
        <livewire:customers.appointments-table :customer="$customer" />
    </div>
@endsection
