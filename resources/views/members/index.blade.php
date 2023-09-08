@extends('layouts.app')

@section('content')
    <h1>Members</h1>
    <a class="btn btn-primary" href="{{ route('members.create') }}" >Insert</a>
    <button><a href="{{ route('home') }}">Go to Home</a></button>

    @foreach ($members as $member)
        <hr>
        
        <a href="{{ route('members.show', $member->id) }}">
            <h2>{{ $member->member_image }}</h2>
        </a>
        
        <a class="btn btn-success" href="{{ route('members.edit', $member->id) }}" >Edit</a>
        <a class="btn btn-danger" href="{{ route('members.delete', $member->id) }}" >Delete</a>
    @endforeach



@endsection
