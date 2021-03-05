@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h2><span class="text-pink">C</span>lients</h2>
            <a href="{{ route('newCustomer') }}" class="btn btn--primary">Nouveau</a>
        </div>
        <div class="card-body">
            <livewire:customers-table />
        </div>
    </div>

@endsection
