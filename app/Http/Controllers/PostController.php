<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{

    /* @return void
    */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(7);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable'
        ]);


        if ($request->hasFile('cover_image')){
            //Get image with extension
            $fileWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get file name without extension
            $filename = pathinfo($fileWithExt, PATHINFO_FILENAME);  
            //Get just extension
            $ext = $request->file('cover_image')->getClientOriginalExtension();
            //Get file name to store
            $fileNameToStore = $filename.'_'.time().'.'.$ext;
            //Upload image
            $path = $request->file('cover_image')->storeAs('public/storage/cover_image', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();
        return redirect('/posts')->with('success', 'Post created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $context = array(
            'post' => $post,
        );
        return view('posts.show')->with($context);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        if ($request->hasFile('cover_image')){
            //Get image with extension
            $fileWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get file name without extension
            $filename = pathinfo($fileWithExt, PATHINFO_FILENAME);  
            //Get just extension
            $ext = $request->file('cover_image')->getClientOriginalExtension();
            //Get file name to store
            $fileNameToStore = $filename.'_'.time().'.'.$ext;
            //Upload image
            $path = $request->file('cover_image')->storeAs('public/storage/cover_image', $fileNameToStore);
        }

        $post = Post::find($id);

        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        }
        $post->save();
        return redirect('/posts')->with('success', 'Post updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if($post->cover_image != 'noimage.jpg'){
            Storage::delete('public/storage/cover_image/'.$post->cover_image);
        }
        $post->delete();
        return redirect('posts/')->with('success', 'Post deleted!');
    }
}
