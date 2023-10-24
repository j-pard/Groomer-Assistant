@extends('manager.layouts.new_app', ['secondNav' => 'dog'])

@section('content')
    <livewire:dogs.timeline :dog="$dog" lazy />
@endsection
