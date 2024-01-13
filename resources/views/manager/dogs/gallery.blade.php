@extends('manager.layouts.new_app', ['secondNav' => 'dog'])

@section('content')
    <livewire:dogs.gallery :dog="$dog" lazy />
@endsection
