<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        // 最近の投稿3件を取得
        $recentPosts = Post::latest()->take(3)->get();

        // InertiaでVueコンポーネントにデータを渡す
        return Inertia::render('HomePage', [
            'recentPosts' => $recentPosts,
        ]);
    }
}
