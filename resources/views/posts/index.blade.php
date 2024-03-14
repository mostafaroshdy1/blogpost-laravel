<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Posts</h5>
                        <a href="{{route('posts.trash')}}" class="btn btn-sm btn-secondary float-right" id="show-deleted">Show Deleted</a>
                    </div>
                    <div class="card-body">
                        @if($posts->count() > 0)
                            <ul class="list-group">
                                @foreach($posts as $post)
                                    <li class="list-group-item" id="post_{{ $post->id }}">
                                        <h6><a href="{{route('posts.show', $post->id)}}"> {{ $post->title }}</a></h6>
                                        <p>{{ $post->id }}</p>
                                        <small>Published At: {{ $post->published_at }}</small><br>
                                        <div class="btn-group mt-2" role="group" aria-label="Post Actions">
                                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <button type="button" class="btn btn-sm btn-danger delete-post" data-post-id="{{ $post->id }}">Delete</button>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>No posts found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var deleteButtons = document.querySelectorAll('.delete-post');

            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var postId = this.getAttribute('data-post-id');
                    if (confirm('Are you sure you want to delete this post?')) {
                        fetch(`/posts/${postId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => {
                            if (response.ok) {
                                document.getElementById(`post_${postId}`).remove();
                            } else {
                                console.error('Error deleting post.');
                            }
                        })
                        .catch(error => {
                            console.error('Error deleting post:', error);
                        });
                    }
                });
            });

           
        });
    </script>
</body>
</html>
