<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use App\Models\Post;
use App\Models\User;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    public function index()
    {
        $posts = $this->postService->getPaginated(4);
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

        $this->postService->createPost($request->validated());
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
        $post = $this->postService->findById($id);
        return view('posts.show', ['post' => $post]);
    }
    public function showTrash()
    {
        $deletedPosts = $this->postService->getTrash();
        return view('posts.trash', ['deletedPosts' => $deletedPosts]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = $this->postService->findById($id);
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $this->postService->updateById($request->validated(), $id);
        return redirect()->route('posts.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->postService->deleteById($id);


        // to recalculate the number of posts for each user => to be changed later
        $users = User::all();
        foreach ($users as $user) {
            $user->update(['posts_count' => Post::where('user_id', $user->id)->count()]);
        }
        return redirect()->route('posts.index');
    }
}
