@extends('layouts.app')

@section('content')
    <style>
        /* Önceki stiller aynı kalacak... (tüm CSS kodları aynı) */
        /* Container */
        .show-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        /* Header */
        .category-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .category-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0 0 1rem 0;
        }

        .category-meta {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
            font-size: 0.95rem;
            opacity: 0.95;
        }

        .category-meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .category-description {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .category-description h2 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1f2937;
            margin: 0 0 1rem 0;
        }

        .category-description p {
            color: #4b5563;
            line-height: 1.8;
            margin: 0;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        /* Sub Categories Section */
        .sub-categories-section {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1f2937;
            margin: 0 0 1.5rem 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .sub-categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1rem;
        }

        .sub-category-card {
            background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
            padding: 1.5rem;
            border-radius: 12px;
            border: 2px solid #e5e7eb;
            transition: all 0.3s;
        }

        .sub-category-card:hover {
            transform: translateY(-3px);
            border-color: #667eea;
            box-shadow: 0 8px 16px rgba(102, 126, 234, 0.1);
        }

        .sub-category-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1f2937;
            margin: 0 0 0.5rem 0;
        }

        .sub-category-meta {
            color: #6b7280;
            font-size: 0.875rem;
        }

        /* Posts Section */
        .posts-section {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .posts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .post-card {
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 1.5rem;
            transition: all 0.3s;
        }

        .post-card:hover {
            transform: translateY(-3px);
            border-color: #667eea;
            box-shadow: 0 8px 16px rgba(102, 126, 234, 0.1);
        }

        .post-title {
            font-size: 1.25rem;
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

        .post-excerpt {
            color: #4b5563;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #9ca3af;
        }

        .empty-state-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .empty-state p {
            font-size: 1.1rem;
            margin: 0;
        }

        /* Buttons */
        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.95rem;
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

        .btn-secondary {
            background: #6b7280;
            color: white;
            box-shadow: 0 2px 4px rgba(107, 114, 128, 0.3);
        }

        .btn-secondary:hover {
            background: #4b5563;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(107, 114, 128, 0.4);
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

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
        }

        /* Breadcrumb */
        .breadcrumb {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            margin-bottom: 1.5rem;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }

        .breadcrumb a {
            color: white;
            text-decoration: none;
            transition: opacity 0.3s;
        }

        .breadcrumb a:hover {
            opacity: 0.8;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .show-container {
                padding: 0 1rem;
            }

            .category-header {
                padding: 1.5rem;
            }

            .category-header h1 {
                font-size: 1.75rem;
            }

            .posts-grid, .sub-categories-grid {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>

    <div class="show-container">
        <!-- Category Header -->
        <div class="category-header">
            <div class="breadcrumb">
                <a href="{{ route('category.index') }}">🏷️ Kategoriler</a>
                <span>›</span>
                @if($category->parent)
                    <a href="{{ route('category.show', $category->parent) }}">{{ $category->parent->name }}</a>
                    <span>›</span>
                @endif
                <span>{{ $category->name }}</span>
            </div>

            <h1>{{ $category->name }}</h1>

            <div class="category-meta">
                <div class="category-meta-item">
                    📊 <strong>{{ $posts->total() }}</strong> Post
                </div>
                <div class="category-meta-item">
                    📁 <strong>{{ $subCategories->count() }}</strong> Alt Kategori
                </div>
                @if($category->parent)
                    <div class="category-meta-item">
                        📂 Üst Kategori: <strong>{{ $category->parent->name }}</strong>
                    </div>
                @endif
                @if($category->created_at)
                    <div class="category-meta-item">
                        📅 {{ $category->created_at->format('d.m.Y') }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="{{ route('category.edit', $category) }}" class="btn btn-warning">
                ✏️ Kategoriyi Düzenle
            </a>
            <form action="{{ route('category.destroy', $category) }}" method="POST" style="display: inline;" onsubmit="return confirm('Bu kategoriyi silmek istediğinize emin misiniz?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    🗑️ Kategoriyi Sil
                </button>
            </form>
            <a href="{{ route('category.index') }}" class="btn btn-secondary">
                ← Kategorilere Dön
            </a>
        </div>

        <!-- Description -->
        @if($category->description)
            <div class="category-description">
                <h2>📄 Açıklama</h2>
                <p>{{ $category->description }}</p>
            </div>
        @endif

        <!-- Sub Categories -->
        @if($subCategories->count() > 0)
            <div class="sub-categories-section">
                <h2 class="section-title">📁 Alt Kategoriler</h2>
                <div class="sub-categories-grid">
                    @foreach($subCategories as $sub)
                        <a href="{{ route('category.show', $sub) }}" style="text-decoration: none;">
                            <div class="sub-category-card">
                                <h3 class="sub-category-name">{{ $sub->name }}</h3>
                                <div class="sub-category-meta">
                                    📊 {{ $sub->posts_count }} Post
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Posts -->
        <div class="posts-section">
            <h2 class="section-title">📝 Bu Kategorideki Postlar</h2>

            @if($posts->count() > 0)
                <div class="posts-grid">
                    @foreach($posts as $post)
                        <div class="post-card">
                            <h3 class="post-title">{{ $post->title }}</h3>
                            <div class="post-meta">
                                👤 {{ $post->user->name ?? 'Anonim' }}
                                @if($post->created_at)
                                    | 📅 {{ $post->created_at->format('d.m.Y H:i') }}
                                @endif
                            </div>
                            <div class="post-excerpt">
                                {{ Str::limit($post->content, 120) }}
                            </div>
                            <a href="{{ route('posts.show', $post) }}" class="btn btn-primary btn-sm">
                                👁️ Devamını Oku
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="pagination">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">📭</div>
                    <p>Bu kategoride henüz post bulunmuyor.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
