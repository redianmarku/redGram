@extends('layouts.app')

@section('content')
    <h1>This is service page.</h1>
   
    @foreach ($services as $service)
    <ul>
        <li class="list-group">{{$service}}</li>
    </ul>
        @endforeach
@endsection