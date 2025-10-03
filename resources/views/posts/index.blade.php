@extends('layouts.app')

@section('content')
    <style>
        /* Container */
        .posts-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .header h1 {
            font-size: 2rem;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
        }

        /* Alert */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
        }

        .alert-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            box-shadow: 0 4px 6px rgba(16, 185, 129, 0.2);
        }

        /* Posts Grid */
        .posts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        /* Post Card */
        .post-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
            border: 2px solid transparent;
        }

        .post-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(102, 126, 234, 0.15);
            border-color: #667eea;
        }

        .post-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1f2937;
            margin: 0 0 0.75rem 0;
            line-height: 1.3;
        }

        .post-meta {
            color: #6b7280;
            font-size: 0.875rem;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .post-content {
            color: #4b5563;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            min-height: 60px;
        }

        /* Post Actions */
        .post-actions {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .delete-form {
            display: inline;
        }

        /* Buttons */
        .btn {
            padding: 0.5rem 1.25rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 2px 4px rgba(102, 126, 234, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(102, 126, 234, 0.4);
        }

        .btn-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            box-shadow: 0 2px 4px rgba(245, 158, 11, 0.3);
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(245, 158, 11, 0.4);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            box-shadow: 0 2px 4px rgba(239, 68, 68, 0.3);
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(239, 68, 68, 0.4);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .empty-state h2 {
            font-size: 2rem;
            color: #1f2937;
            margin-bottom: 1rem;
        }

        .empty-state p {
            color: #6b7280;
            font-size: 1.125rem;
            margin-bottom: 2rem;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .posts-container {
                padding: 0 1rem;
            }

            .posts-grid {
                grid-template-columns: 1fr;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .header h1 {
                font-size: 1.5rem;
            }

            .post-actions {
                width: 100%;
            }

            .btn {
                flex: 1;
                text-align: center;
            }
        }
    </style>

    <div class="posts-container">
        <div class="header">
            <h1>📝 Blog Postları</h1>
            <a href="{{ route('posts.create') }}" class="btn btn-primary">✨ Yeni Post Ekle</a>
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
                            <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">👁️ Görüntüle</a>
                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning">✏️ Düzenle</a>
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="delete-form" onsubmit="return confirm('Bu postu silmek istediğinize emin misiniz?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">🗑️ Sil</button>
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
                <h2>📭 Henüz Post Yok</h2>
                <p>İlk blog postunuzu oluşturmak için butona tıklayın!</p>
                <a href="{{ route('posts.create') }}" class="btn btn-primary">✨ İlk Postu Oluştur</a>
            </div>
        @endif
    </div>

    <script>
        // Delete confirmation zaten form onsubmit'te var
        // İstersen buraya ek JavaScript ekleyebilirsiniz
    </script>
@endsection
