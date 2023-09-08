@extends('layouts.app')

@section('content')
    <h1>Member ID {{ $member->id }}</h1>
    <h2>{{ $member->member_image }}</h2>
    <hr>
    <a href="{{ route('members.index') }}">Back</a>
@endsection
