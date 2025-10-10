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


    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        // User ID'yi ekle
        $data['user_id'] = auth()->id() ?? 1;

        // Postu oluştur
        $post = Post::create($data);

        // Kategorileri iliştir
        if ($request->has('category_ids')) {
            $post->categories()->attach($request->category_ids);
        }

        // Tagleri iliştir
        if ($request->has('tag_ids')) {
            $post->tags()->attach($request->tag_ids);
        }

        return redirect()->route('posts.index')
            ->with('success', 'Post başarıyla eklendi!');
    }


    // Tek bir postu göster
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }


//    public function update(UpdatePostRequest $request, Post $post)
//    {
//        $post->update($request->validated());
//
//        if ($request->has('category_ids')) {
//            $post->categories()->sync($request->category_ids);
//        }
//
//        if ($request->has('tag_ids')) {
//            $post->tags()->sync($request->tag_ids);
//        }
//
//        return redirect()->route('posts.index')->with('success', 'Post güncellendi!');
//    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();

        // Postu güncelle
        $post->update($data);

        // Kategorileri senkronize et
        if ($request->has('category_ids')) {
            $post->categories()->sync($request->category_ids);
        } else {
            // Eğer category_ids gönderilmemişse, tüm kategorileri temizle
            $post->categories()->sync([]);
        }

        // Tagleri senkronize et
        if ($request->has('tag_ids')) {
            $post->tags()->sync($request->tag_ids);
        } else {
            // Eğer tag_ids gönderilmemişse, tüm tagleri temizle
            $post->tags()->sync([]);
        }

        return redirect()->route('posts.index')
            ->with('success', 'Post başarıyla güncellendi!');
    }

    // Postu sil
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post silindi!');
    }
}
