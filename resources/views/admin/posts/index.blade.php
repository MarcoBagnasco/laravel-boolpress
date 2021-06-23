@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('deleted'))
            <div class="alert alert-success">
                <strong>{{session('deleted')}}</strong>
                deleted successfully
            </div>
        @endif

        <h1>Our Posts</h1>
        <a class="btn btn-primary mb-5" href="{{route('admin.posts.create')}}">Create New Post</a>

        <table class="table table-striped table-dark mb-5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td>{{$post->title}}</td>
                        <td>@if ($post->category) {{$post->category->name}}@endif</td>
                        <td>
                            <a class="btn btn-success" href="{{ route('admin.posts.show', $post->id) }}">SHOW</a>
                        </td>
                        <td>
                            <a class="btn btn-warning" href="{{route('admin.posts.edit', $post->id)}}">EDIT</a>
                        </td>
                        <td>
                            <form class="delete-post-form" action="{{ route('admin.posts.destroy', $post->id )}}" method='POST'>
                                @csrf
                                @method('DELETE')

                                <input class="btn btn-danger" type="submit" value="DELETE">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="row">
            <!-- Post Order by Category-->
            <div class="col-md-6">
                <h2>Post by Categories</h2>
                @foreach ($categories as $category)
                    <h3 class="mt-4">{{$category->name}}</h3>
                    @forelse ($category->posts as $post)
                        <h4>
                            <a href="{{route('admin.posts.show', $post->id)}}">{{$post->title}}</a>
                        </h4>
                    @empty
                        No Posts. <a href="{{route('admin.posts.create')}}">Create New Post</a>
                    @endforelse
                @endforeach
            </div>
            <div class="col-md-6">
                <h2 class="mb-4">Tags</h2>
                @foreach ($tags as $tag)
                    <div>
                        <h2 class="d-inline-block mb-3 mr-3"><span class="badge badge-primary">{{$tag->name}}</span></h2>
                        @if(count($tag->posts) > 0)
                            @foreach ($tag->posts as $post)
                                <a href="{{route('admin.posts.show', $post->id)}}">{{$post->title}}</a>
                                @if (!$loop->last)
                                    <span class="ml-2 mr-2">-</span>
                                @endif
                            @endforeach
                        @endif
                    </div>
                    {{-- <span class="d-inline-block mr-3"></span> --}}
                @endforeach

            </div>
        </div>
    </div>
@endsection