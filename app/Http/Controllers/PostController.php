<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    // Tüm postları listele
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    // Yeni post formu
    public function create()
    {
        return view('posts.create');
    }

    // Yeni post kaydet
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        $post = $request->user()
            ? $request->user()->posts()->create($data)
            : Post::create($data + ['user_id' => 1]);

        return redirect()->route('posts.index')->with('success', 'Post başarıyla eklendi!');
    }

    // Tek bir postu göster
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // Post düzenleme formu
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    // Postu güncelle
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->validated());
        return redirect()->route('posts.index')->with('success', 'Post güncellendi!');
    }

    // Postu sil
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post silindi!');
    }
}
