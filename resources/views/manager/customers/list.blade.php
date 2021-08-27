@extends('manager.layouts.app')

@section('content')
    <header>
        <h2><span class="text-pink">C</span>lients</h2>
        <div>
            <a href="{{ route('customers.create') }}" class="btn btn--primary">Nouveau</a>
        </div>
    </header>

    @include('manager.partials.session-message')

    <livewire:customers.table />

@endsection
