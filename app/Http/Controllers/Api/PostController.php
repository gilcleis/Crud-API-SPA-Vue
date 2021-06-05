<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {        
        $posts = Post::orderBy('created_at','desc')->paginate(8);
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
