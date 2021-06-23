@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>
            {{$post->title}}
            <a class="btn btn-warning" href="{{route('admin.posts.edit', $post->id)}}">EDIT</a>
        </h1>

        @if ($post->category)
            <h3>Category: {{$post->category->name}}</h3>
        @else
            <h3>No Category</h3>
        @endif
        
        @if(count($post->tags) > 0)
            @foreach ($post->tags as $tag)
                <span class="badge badge-primary mb-3">{{$tag->name}}</span>
            @endforeach
        @endif

        <p class="mb-5">{{$post->content}}</p>

        <a href="{{route('admin.posts.index')}}">Return to Archive</a>
    </div>
@endsection