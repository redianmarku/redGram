@extends('layouts.app')

@section('content')
    <h1 class="text-center"></h1>
    
    <form action="{{ action('PostController@update', $post->id) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        @method('PUT')
        <div class="form-group">
            <label for="text">Title</label>
        <input value="{{$post->title}}"  type="text" name="title" class="form-control" />
        </div>
        <div class="form-group">
            <label for="body">Body</label>
        <textarea class="form-control"  name="body" id="body" rows="6" >{{$post->body}}</textarea>
        </div>
        <div class="form-group">
            <label for="image">Add a cover image.</label>
            <input name="cover_image" class="form-control" type="file">
        </div>
        <input type="submit" value="Save" class="btn btn-primary">
    </form>
@endsection