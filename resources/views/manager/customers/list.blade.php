@extends('manager.layouts.app')

@section('content')
    <header class="d-flex justify-content-between align-items-center mb-2">
        <h2><span class="text-pink">C</span>lients</h2>
        <div>
            <a href="{{ route('customers.create') }}" class="btn btn--primary">Nouveau</a>
        </div>
    </header>

    <div class="table-container">
        <livewire:customers.table />
    </div>
@endsection
