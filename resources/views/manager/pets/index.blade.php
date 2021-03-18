@extends('layouts.app')

@section('content')
    <header>
        <h2><span class="text-pink">C</span>hiens</h2>
        <div>
            <a href="{{ route('newPet') }}" class="btn btn--primary">Nouveau</a>
        </div>
    </header>

    <div>
        <livewire:pets-table />
    </div>

@endsection
