<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminPostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required','string','max:255'],
            'content' => ['required','string'],
        ]);

        $slug = Str::slug($data['title']);
        $base = $slug;
        $i = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }

        Post::create([
            'title' => $data['title'],
            'slug' => $slug,
            'content' => $data['content'],
        ]);

        return redirect()->route('admin.posts.index')->with('ok', 'Пост создан');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => ['required','string','max:255'],
            'content' => ['required','string'],
        ]);

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('ok', 'Пост обновлён');
    }

 public function destroy(Post $post)
{
    if ($post->user_id !== auth()->id()) {
        abort(403);
    }

    $post->delete();
    return back()->with('ok', 'Тема удалена');
}


}
