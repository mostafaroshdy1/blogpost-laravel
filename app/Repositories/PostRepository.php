<?php

namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;


class PostRepository extends EloquentRepository
{
    public function __construct(Post $post)
    {
        parent::__construct($post);
    }

    public function paginate($pages)
    {
        return Post::with('user')->orderByDesc('created_at')->paginate($pages);
    }
    public function create(array $data)
    {
        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $data['title'];
        $post->body = $data['body'];
        $post->enabled = 0;
        $post->published_at = now();
        if (isset($data['image'])) {
            $imagePath = $data['image']->store('posts', ['disk' => 'public']);
            $post->image = $imagePath;
        }

        $post->save();
        return $post;
    }
    public function getTrash()
    {
        return Post::onlyTrashed()->get();
    }
}
