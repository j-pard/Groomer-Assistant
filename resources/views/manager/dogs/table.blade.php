@extends('manager.layouts.app')

@section('content')
    <header class="d-flex justify-content-between align-items-center mb-2">
        <h2><span class="text-pink">C</span>hiens</h2>
    </header>
    
    <div class="table-container">
        <livewire:dogs.table />
    </div>
@endsection
