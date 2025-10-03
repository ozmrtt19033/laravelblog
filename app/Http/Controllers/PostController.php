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

    public function create()
    {
        $categories = \App\Models\Category::all();
        $tags = \App\Models\Tag::all();

        return view('posts.create', compact('categories', 'tags'));
    }

    public function edit(Post $post)
    {
        $categories = \App\Models\Category::all();
        $tags = \App\Models\Tag::all();

        return view('posts.edit', compact('post', 'categories', 'tags'));
    }


    // Yeni post formu
//    public function create()
//    {
//        return view('posts.create');
//    }

    // Yeni post kaydet
//    public function store(StorePostRequest $request)
//    {
//        $data = $request->validated();
//
//        $post = $request->user()
//            ? $request->user()->posts()->create($data)
//            : Post::create($data + ['user_id' => 1]);
//
//        return redirect()->route('posts.index')->with('success', 'Post başarıyla eklendi!');
//    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        // Postu oluştur
        $post = $request->user()
            ? $request->user()->posts()->create($data)
            : Post::create($data + ['user_id' => 1]);

        // Kategorileri ve tagleri iliştir
        if ($request->has('category_ids')) {
            $post->categories()->attach($request->category_ids);
        }

        if ($request->has('tag_ids')) {
            $post->tags()->attach($request->tag_ids);
        }

        return redirect()->route('posts.index')->with('success', 'Post başarıyla eklendi!');
    }


    // Tek bir postu göster
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // Post düzenleme formu
//    public function edit(Post $post)
//    {
//        return view('posts.edit', compact('post'));
//    }

    // Postu güncelle
//    public function update(UpdatePostRequest $request, Post $post)
//    {
//        $post->update($request->validated());
//        return redirect()->route('posts.index')->with('success', 'Post güncellendi!');
//    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->validated());

        if ($request->has('category_ids')) {
            $post->categories()->sync($request->category_ids);
        }

        if ($request->has('tag_ids')) {
            $post->tags()->sync($request->tag_ids);
        }

        return redirect()->route('posts.index')->with('success', 'Post güncellendi!');
    }


    // Postu sil
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post silindi!');
    }
}
