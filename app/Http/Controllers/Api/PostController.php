<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {        
        $sort_field= $request->get('sort_field','created_at');
        $sort_direction= $request->get('sort_direction','desc');
        $posts = Post::orderBy($sort_field,$sort_direction)->paginate(8);
        // if(!empty($request->sort_field)&& $request->sort_direction=='desc' ){
        //     $posts = Post::orderBy($request->sort_field,'desc')->paginate(8);
        // }
        // else {
        //     $posts = Post::orderBy($request->sort_field,'asc')->paginate(8);
        // }        
        return PostResource::collection($posts);
    }

    public function store(PostRequest $request)
    {        
        $post = Post::create($request->validated());
        return new PostResource($post);
    }

    public function show(Post $post)
    {       
        return new PostResource($post);
    }

    public function update(Post $post, PostRequest $request)
    {
        $post->update($request->validated());
        return new PostResource($post);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->noContent();
    }
}
