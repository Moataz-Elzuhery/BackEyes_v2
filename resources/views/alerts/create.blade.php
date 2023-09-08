@extends('layouts.app')

@section('content')
    <h1>Create</h1>


    @include('inc.errors')
    <form method="POST" action="{{route('alerts.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">

            <input type="file" name="alert_image" class="form-control-file" >

        </div>
        

        <button type="submit" class="btn btn-primary">Insert</button>
    </form>
@endsection
