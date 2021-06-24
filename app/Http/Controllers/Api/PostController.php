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
}
