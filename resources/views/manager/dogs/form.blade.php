@extends('manager.layouts.new_app', ['secondNav' => 'dog'])

@section('content')
    <livewire:dogs.form :dog="$dog" />
@endsection
