@extends('layouts.app')

@section('content')
    <h1 class="text-center" >View Post</h1>

    <div class="col-md-12 blogShort">
        <h1>{{$post->title }}</h1>
            <img src="../storage/storage/cover_image/{{$post->cover_image}}" alt="post img" class="pull-left img-responsive thumb margin10 img-thumbnail">
            <article><p>
            {{$post->body}}
                </p></article>
             
        @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
            <form action="{{ action('PostController@destroy', $post->id) }}" method="POST">
                {{ csrf_field() }}
                @method('DELETE')
                <a class="btn btn-primary" href="/posts/{{$post->id}}/edit">Edit</a>
                <input class="btn btn-danger" value="Delete" type="submit"> 
            </form>
        @endif
        @endif
    </div>

@endsection