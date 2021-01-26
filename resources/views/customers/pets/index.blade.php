@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2><span class="text-pink">P</span>ets</h2>
            <a href="{{ route('newPet') }}" class="btn btn-primary">Nouveau</a>
        </div>
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>

@endsection
    
@push('scripts')
    {{ $dataTable->scripts() }}
@endpush