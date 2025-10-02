<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Postları</title>
    <link rel="stylesheet" href="{{ asset('css/posts.css') }}">
</head>
<body>
<div class="container">
    <div class="header">
        <h1>📝 Blog Postları</h1>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">+ Yeni Post Ekle</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if($posts->count() > 0)
        <div class="posts-grid">
            @foreach($posts as $post)
                <div class="post-card">
                    <h2 class="post-title">{{ $post->title }}</h2>
                    <div class="post-meta">
                        👤 {{ $post->user->name ?? 'Anonim' }} |
                        📅 {{ $post->created_at->format('d.m.Y H:i') }}
                    </div>
                    <div class="post-content">
                        {{ Str::limit($post->content, 150) }}
                    </div>
                    <div class="post-actions">
                        <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">Görüntüle</a>
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning">Düzenle</a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Sil</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pagination">
            {{ $posts->links() }}
        </div>
    @else
        <div class="empty-state">
            <h2>Henüz Post Yok</h2>
            <p>İlk blog postunuzu oluşturmak için butona tıklayın!</p>
            <a href="{{ route('posts.create') }}" class="btn btn-primary">İlk Postu Oluştur</a>
        </div>
    @endif
</div>

<script src="{{ asset('js/posts.js') }}"></script>
</body>
</html>
