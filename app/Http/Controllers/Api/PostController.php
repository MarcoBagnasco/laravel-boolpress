<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Get Blog Posts
     */
    public function index(){
        // $posts = Post::all();

        $posts = Post::paginate(3);

        return response()->json($posts);
    }

    /**
     * Get Post Detail by Slug
     */
    public function show($slug){

        $post = Post::where('slug', $slug)->with(['category', 'tags'])->first();

        return response()->json($post);
    }
}
