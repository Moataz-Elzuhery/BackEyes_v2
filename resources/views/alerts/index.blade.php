@extends('layouts.app')

@section('content')
    <h1>Alerts</h1>
    <a class="btn btn-primary" href="{{ route('alerts.create') }}" >Insert</a>
    <button><a href="{{ route('home') }}">Go to Home</a></button>

    @foreach ($alerts as $alert)
        <hr>
        
        <a href="{{ route('alerts.show', $alert->id) }}">
            <h2>{{ $alert->alert_image }}</h2>
        </a>
        
        <a class="btn btn-success" href="{{ route('alerts.edit', $alert->id) }}" >Edit</a>
        <a class="btn btn-danger" href="{{ route('alerts.delete', $alert->id) }}" >Delete</a>
    @endforeach



@endsection
