<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class CheckPostOwner
{

    public function handle(Request $request, Closure $next): Response
    {
        $post = Post::find($request->id);
        if ($post && $post->user_id == Auth::id()) {
            return $next($request);
        }
        abort(403);
    }
}
