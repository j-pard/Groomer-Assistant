@extends('manager.layouts.app')

@section('content')
    <header>
        <h2><span class="text-pink">C</span>hiens</h2>
        <div>
            <a href="{{ route('pets.create') }}" class="btn btn--primary">Nouveau</a>
        </div>
    </header>
    
    <livewire:pets.table />
@endsection
