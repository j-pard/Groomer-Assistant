@extends('layouts.app')

@section('content')
    <header>
        <h2><span class="text-pink">C</span>lients</h2>
        <div>
            <a href="{{ route('newCustomer') }}" class="btn btn--primary">Nouveau</a>
        </div>
    </header>

    <div>
        <livewire:customers-table />
    </div>


@endsection
