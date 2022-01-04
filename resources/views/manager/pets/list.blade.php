@extends('manager.layouts.app')

@section('content')
    <header class="mb-2">
        <h2><span class="text-pink">C</span>hiens</h2>
        <div>
            <a href="{{ route('pets.create') }}" class="btn btn--primary">Nouveau</a>
        </div>
    </header>
    
    <div class="table-container">
        <livewire:pets.table />
    </div>
@endsection
