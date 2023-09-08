@extends('layouts.app')

@section('content')
    <h1>Alert ID {{ $alert->id }}</h1>
    <h2>{{ $alert->alert_image }}</h2>
    <hr>
    <a href="{{ route('alerts.index') }}">Back</a>
@endsection
