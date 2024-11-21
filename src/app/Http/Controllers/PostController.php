<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->get();

        return Inertia::render('Posts/Index', [
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        return Inertia::render('Posts/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('posts.index')->with('success', '記事が作成されました');
    }

    public function show(Post $post)
    {
        $relatedPosts = Post::where('id', '!=', $post->id)
            ->latest()
            ->take(3)
            ->get();
    
        return Inertia::render('Posts/Show', [
            'post' => [
                'title' => $post->title,
                'content' => $post->content,
                'created_at' => Carbon::parse($post->created_at)->timezone('Asia/Tokyo')->format('Y年 n月 j日 H:i'),
                'user' => $post->user, // 必要に応じてリレーションをロード
            ],
            'relatedPosts' => $relatedPosts,
        ]);
    }
}