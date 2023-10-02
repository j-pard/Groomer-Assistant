@extends('manager.layouts.new_app', ['secondNav' => 'dog'])

@section('content')
    @include('livewire.partials.form-header')

    <livewire:dogs.timeline :dog="$dog" lazy />
@endsection
