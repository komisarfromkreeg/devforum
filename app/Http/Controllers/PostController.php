<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->query('q', ''));

        $posts = Post::query()
            ->with('user') // чтобы показать автора
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('title', 'like', "%{$q}%")
                        ->orWhere('content', 'like', "%{$q}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('posts.index', compact('posts', 'q'));
    }

    public function show(string $slug)
    {
        $post = Post::with(['user', 'comments.user'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('posts.show', compact('post'));
    }

    // форма создания темы (только auth, см. web.php)
    public function create()
    {
        return view('posts.create');
    }

    // сохранение темы (только auth, см. web.php)
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'   => ['required', 'string', 'min:5', 'max:255'],
            'content' => ['required', 'string', 'min:10'],
        ]);

        // slug делаем "безопасно" и почти уникально
        $baseSlug = Str::slug($data['title']);
        $slug = $baseSlug;
        $i = 2;

        while (Post::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }

        Post::create([
            'user_id' => auth()->id(),
            'title'   => $data['title'],
            'slug'    => $slug,
            'content' => $data['content'],
        ]);

        return redirect()->route('posts.index')->with('ok', 'Тема успешно создана!');      
    }

    public function destroy(Post $post)
{
    // удалять может только автор темы
    if ($post->user_id !== auth()->id()) {
        abort(403);
    }

    $post->delete();

    return redirect()->route('posts.index')->with('ok', 'Тема удалена.');
}
public function edit(Post $post)
{
    if ($post->user_id !== auth()->id()) {
        abort(403);
    }

    return view('posts.edit', compact('post'));
}

public function update(Request $request, Post $post)
{
    if ($post->user_id !== auth()->id()) {
        abort(403);
    }

    $data = $request->validate([
        'title'   => ['required', 'string', 'min:5', 'max:255'],
        'content' => ['required', 'string', 'min:10'],
    ]);

    // если заголовок изменился — обновим slug
    if ($data['title'] !== $post->title) {
        $baseSlug = Str::slug($data['title']);
        $slug = $baseSlug;
        $i = 2;

        while (Post::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }

        $post->slug = $slug;
    }

    $post->title = $data['title'];
    $post->content = $data['content'];
    $post->save();

    return redirect()->route('posts.show', $post->slug)->with('ok', 'Тема обновлена.');
}

}
