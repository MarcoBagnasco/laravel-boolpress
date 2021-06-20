@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{$post->title}}</h1>
        <a class="btn btn-warning" href="{{route('admin.posts.edit', $post->id)}}">EDIT</a>

        <p>{{$post->content}}</p>

        <a href="{{route('admin.posts.index')}}">Return to Archive</a>
    </div>
@endsection