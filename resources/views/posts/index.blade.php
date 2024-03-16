@extends('layouts.main')

@section('title', 'Posts')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Posts</h5>
                </div>
                <div class="card-body">
                    @if($posts->count() > 0)
                        <ul class="list-group">
                            @foreach($posts as $post)
                                <li class="list-group-item" id="post_{{ $post->id }}">
                                    <h6><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></h6>
                                    <p>{{ $post->id }}</p>
                                    <small>Published At: {{ $post->published_at }}</small><br>
                                    <small>Posted By: {{ $post->user->name }}</small><br> <!-- Displaying username -->
                                    <div class="btn-group mt-2" role="group" aria-label="Post Actions">
                                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline;">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <!-- Pagination Links -->
                        <div class="mt-4 d-flex justify-content-center"> <!-- Center the pagination -->
                            {{ $posts->links() }}
                        </div>
                    @else
                        <p>No posts found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
