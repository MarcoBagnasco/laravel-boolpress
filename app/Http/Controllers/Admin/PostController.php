<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;
use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $categories = Category::all();
        $tags = Tag::all();


        return view('admin.posts.index', compact('posts', 'categories', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validation
        $request->validate([
            'title' => 'required|unique:posts|max:255',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id'
        ], [
            'required' => 'The :attribute is required!!!',
            'unique' => 'The :attribute is already used',
            'max' => 'Max :max characters allowed for the :attribute'
        ]);

        $data = $request->all();

        // Slug
        $data['slug'] = Str::slug($data['title'], '-');

        $new_post = new Post();
        $new_post->fill($data);
        $new_post->save();

        // Save Relation in Pivot Table
        if(array_key_exists('tags', $data)){
            $new_post->tags()->attach($data['tags']);
        }

        return redirect()->route('admin.posts.show', $new_post->id);
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

        if($post){
            return view('admin.posts.show', compact('post'));
        }

        abort(404);
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
        $categories = Category::all();
        $tags = Tag::all(); 

        if(!$post){
            abort(404);
        }
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
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
        //Validation
        $request->validate([
            'title' => [
                'required',
                'max:255',
                Rule::unique('posts')->ignore($id),
            ],
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id'
        ], [
            'required' => 'The :attribute is required!!!',
            'unique' => 'The :attribute is already used',
            'max' => 'Max :max characters allowed for the :attribute'
        ]);

        $data = $request->all();

        $post = Post::find($id);

        //Slug
        if($data['title'] != $post->title){
            $data['slug'] = Str::slug($data['title'], '-');
        }

        $post->update($data);

        // Update Relation in Pivot Table
        if(array_key_exists('tags', $data)){
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->detach();
        }

        return redirect()->route('admin.posts.show', $id);
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

        // Remove records from pivot
        $post->tags()->detach();

        // Remove
        $post->delete();

        return redirect()->route('admin.posts.index')->with('deleted', $post->title);
    }
}
