@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">Create New Post</h1>

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
                <form action="{{route('admin.posts.store')}}" method="POST">
                    @csrf
                    @method('POST')
        
                    <div class="mb-3">
                        <label class="form-label" for="title">Title*</label>
                        <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{old('title')}}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="content">Content*</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" rows="6">{{old('content')}}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
        
                    <button class="btn btn-primary" type="submit">Create Post</button>
                </form>
            </div>
        </div>
    </div>
@endsection