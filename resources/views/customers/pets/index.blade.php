@extends('layouts.app')

@section('content')
    <h2>Pets</h2>
    {{ $dataTable->table() }}

@endsection
    
@push('scripts')
    {{ $dataTable->scripts() }}
@endpush