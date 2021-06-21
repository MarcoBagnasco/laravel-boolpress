@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">
            Edit Post: <a href="{{route('admin.posts.show', $post->id)}}">{{$post->title}}</a>
        </h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <form action="{{route('admin.posts.update', $post->id)}}" method="POST">
                    @csrf
                    @method('PATCH')
        
                    <div class="mb-3">
                        <label class="form-label" for="title">Title*</label>
                        <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{old('title', $post->title)}}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="content">Content*</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" rows="6">{{old('content', $post->content)}}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category_id">Category</label>
                        <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}" @if($category->id == old('category_id', $post->category_id)) selected @endif>{{$category->name}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button class="btn btn-primary" type="submit">Update Post</button>
                </form>
            </div>
        </div>
    </div>
@endsection