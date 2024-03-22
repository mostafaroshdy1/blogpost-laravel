<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')->orderByDesc('created_at')->paginate(4);
        return view('posts.index', ["posts" => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $validatedData = $request->validated();
        $post = new Post();
        $post->title = $validatedData['title'];
        $post->body = $validatedData['body'];
        $post->user_id = Auth::id();
        $post->enabled = 0;
        $post->published_at = now();
        if ($request->has('image') && $request->file("image")->isValid()) {
            $imagePath = $request->file('image')->store('posts', ['disk' => 'public']);
            $post->image = $imagePath;
        }
        $post->save();
        $user = User::find(Auth::id());
        $user->posts_count++;
        $user->save();
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        return view('posts.show', ['post' => $post]);
    }
    public function showTrash()
    {
        $deletedPosts = Post::onlyTrashed()->get();
        return view('posts.trash', ['deletedPosts' => $deletedPosts]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $validatedData = $request->validated();
        Post::where('id', $id)->update([
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
        ]);;
        return redirect()->route('posts.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Post::find($id)->delete();
        // to recalculate the number of posts for each user => to be changed later
        $users = User::all();
        foreach ($users as $user) {
            $user->update(['posts_count' => Post::where('user_id', $user->id)->count()]);
        }
        return redirect()->route('posts.index');
    }
}
