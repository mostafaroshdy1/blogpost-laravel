@extends('layouts.main')

@section('title', $post->title)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ $post->title }}</h5>
                    </div>
                    <div class="card-body">
                        <p>{{ $post->body }}</p>
                        <small>Created: {{ $post->created_at }}</small><br>
                        <small>Updated: {{ $post->updated_at }}</small><br>
                        <div class="mt-2">
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                            <a href="{{ route('posts.index') }}" class="btn btn-sm btn-secondary">Back to Posts</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
