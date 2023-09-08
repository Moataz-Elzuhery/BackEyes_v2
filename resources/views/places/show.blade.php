@extends('layouts.app')

@section('content')
    <h1>Place ID {{ $place->id }}</h1>
    <h2>{{ $place->place_image }}</h2>
    <hr>
    <a href="{{ route('places.index') }}">Back</a>
@endsection
