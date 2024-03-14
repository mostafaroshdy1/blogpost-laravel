<!-- resources/views/posts/trash.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trash</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Trash</h5>
                    </div>
                    <div class="card-body">
                        @if($deletedPosts->count() > 0)
                            <ul class="list-group">
                                @foreach($deletedPosts as $post)
                                    <li class="list-group-item" id="post_{{ $post->id }}">
                                        <h6>{{ $post->title }}</h6>
                                        <p>{{ $post->id }}</p>
                                        <small>Deleted At: {{ $post->deleted_at }}</small><br>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>No posts found in trash.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</body>
</html>
