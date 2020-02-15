@extends('layouts.app')


@section('content')
    <h3>All posts:</h3>
    @if(count($posts) > 0)
    @foreach($posts as $post)

    <div class=" card col-md-12 blogShort">
    <div class="row">
    <div class="col-sm-10"><h1><a href="/posts/{{$post->id}}">{{$post->title }}</a></h1></div><div class="col-sm-2"><p class="text-right mt-3">Created at {{$post->created_at}} by {{$post->user->name}}.</p></div>
    </div>
<img width="100" src="storage/storage/cover_image/{{$post->cover_image}}" alt="post img" class="pull-left img-responsive thumb margin10 img-thumbnail">
        <article><p>
        {{ $post->body }}
            </p></article>
        <a class="btn btn-primary pull-right marginBottom10" href="/posts/{{$post->id}}">READ MORE</a> 
    </div>
<br><br>
    @endforeach
    @else
    <h5>No posts.</h5>
    @endif
    {{$posts->links()}}
@endsection