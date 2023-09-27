@extends('manager.layouts.new_app')

@section('content')
    <livewire:dogs.form :dog="$dog" />
@endsection
