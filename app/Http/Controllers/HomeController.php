<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $latestPosts = Post::query()
            ->with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('home', compact('latestPosts'));
    }
}
