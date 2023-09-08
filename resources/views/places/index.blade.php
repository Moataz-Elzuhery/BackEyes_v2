@extends('layouts.app')

@section('content')
    <h1>Places</h1>
    <a class="btn btn-primary" href="{{ route('places.create') }}" >Insert</a>
    <button><a href="{{ route('home') }}">Go to Home</a></button>

    @foreach ($places as $place)
        <hr>
        
        <a href="{{ route('places.show', $place->id) }}">
            <h2>{{ $place->place_image }}</h2>
        </a>
        
        <a class="btn btn-success" href="{{ route('places.edit', $place->id) }}" >Edit</a>
        <a class="btn btn-danger" href="{{ route('places.delete', $place->id) }}" >Delete</a>
    @endforeach



@endsection
