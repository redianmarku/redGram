@extends('layouts.app')

@section('content')
<h2>Create a post</h2>
<form action="{{ action('PostController@store') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="text">Title</label>
        <input type="text" name="title" class="form-control" placeholder="Enter title"/>
    </div>
    <div class="form-group">
        <label for="body">Body</label>
        <textarea class="form-control"  name="body" id="body" rows="10" placeholder="Enter details"></textarea>
    </div>
    <div class="form-group">
        <label for="image">Add a cover image.</label>
        <input name="cover_image" class="form-control" type="file">
    </div>
    <input type="submit" value="Submit" class="btn btn-primary">
    
</form>
@endsection