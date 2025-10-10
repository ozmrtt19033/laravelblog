@extends('layouts.app')

@section('content')
    <style>
        /* Container */
        .show-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        /* Header */
        .tag-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .tag-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0 0 1rem 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .tag-meta {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
            font-size: 0.95rem;
            opacity: 0.95;
        }

        .tag-meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .tag-description {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .tag-description h2 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1f2937;
            margin: 0 0 1rem 0;
        }

        .tag-description p {
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

        /* Posts Section */
        .posts-section {
            background: white;
            padding: 2rem;
            border-radius: 16px;
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

        .posts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.5rem;
        }

        .post-card {
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 1.5rem;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .post-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            display: flex;
            gap: 1rem;
            color: #6b7280;
            font-size: 0.875rem;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e5e7eb;
            flex-wrap: wrap;
        }

        .post-meta-item {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .post-excerpt {
            color: #4b5563;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .post-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .post-tag {
            background: #f3f4f6;
            color: #6b7280;
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            font-size: 0.75rem;
            text-decoration: none;
            transition: all 0.3s;
        }

        .post-tag:hover {
            background: #667eea;
            color: white;
        }

        .post-tag.current {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-weight: 600;
        }

        .post-categories {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .post-category {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            color: #92400e;
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            font-size: 0.75rem;
            text-decoration: none;
            transition: all 0.3s;
        }

        .post-category:hover {
            background: linear-gradient(135deg, #fde68a 0%, #fcd34d 100%);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 1rem;
            color: #9ca3af;
        }

        .empty-state-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            color: #6b7280;
            margin: 0 0 0.5rem 0;
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

        /* Stats Box */
        .stats-box {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 1.5rem;
            border-radius: 12px;
            margin-top: 1.5rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            display: block;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.875rem;
            opacity: 0.9;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .show-container {
                padding: 0 1rem;
            }

            .tag-header {
                padding: 1.5rem;
            }

            .tag-header h1 {
                font-size: 1.75rem;
            }

            .posts-grid {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                text-align: center;
            }

            .stats-box {
                grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            }

            .stat-value {
                font-size: 1.5rem;
            }
        }
    </style>

    <div class="show-container">
        <!-- Tag Header -->
        <div class="tag-header">
            <div class="breadcrumb">
                <a href="{{ route('tags.index') }}">🏷️ Etiketler</a>
                <span>›</span>
                <span>{{ $tag->name }}</span>
            </div>

            <h1>#️⃣ {{ $tag->name }}</h1>

            <div class="tag-meta">
                <div class="tag-meta-item">
                    🔗 <strong>{{ $tag->slug }}</strong>
                </div>
                <div class="tag-meta-item">
                    📊 <strong>{{ $posts->total() }}</strong> Post
                </div>
                @if($tag->created_at)
                    <div class="tag-meta-item">
                        📅 {{ $tag->created_at->format('d.m.Y') }}
                    </div>
                @endif
            </div>

            @if($posts->total() > 0)
                <div class="stats-box">
                    <div class="stat-item">
                        <span class="stat-value">{{ $posts->total() }}</span>
                        <span class="stat-label">Toplam Post</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value">{{ $posts->sum(function($post) { return $post->categories->count(); }) }}</span>
                        <span class="stat-label">Toplam Kategori</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value">{{ $posts->unique('user_id')->count() }}</span>
                        <span class="stat-label">Farklı Yazar</span>
                    </div>
                </div>
            @endif
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="{{ route('tags.edit', $tag) }}" class="btn btn-warning">
                ✏️ Etiketi Düzenle
            </a>
            <form action="{{ route('tags.destroy', $tag) }}" method="POST" style="display: inline;" onsubmit="return confirm('Bu etiketi silmek istediğinize emin misiniz?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    🗑️ Etiketi Sil
                </button>
            </form>
            <a href="{{ route('tags.index') }}" class="btn btn-secondary">
                ← Etiketlere Dön
            </a>
        </div>

        <!-- Description -->
        @if($tag->description)
            <div class="tag-description">
                <h2>📄 Açıklama</h2>
                <p>{{ $tag->description }}</p>
            </div>
        @endif

        <!-- Posts -->
        <div class="posts-section">
            <h2 class="section-title">📝 Bu Etikete Sahip Postlar</h2>

            @if($posts->count() > 0)
                <div class="posts-grid">
                    @foreach($posts as $post)
                        <div class="post-card">
                            <h3 class="post-title">{{ $post->title }}</h3>

                            <div class="post-meta">
                                <div class="post-meta-item">
                                    👤 {{ $post->user->name ?? 'Anonim' }}
                                </div>
                                @if($post->created_at)
                                    <div class="post-meta-item">
                                        📅 {{ $post->created_at->format('d.m.Y') }}
                                    </div>
                                @endif
                            </div>

                            @if($post->categories && $post->categories->count() > 0)
                                <div class="post-categories">
                                    @foreach($post->categories as $category)
                                        <a href="{{ route('category.show', $category) }}" class="post-category">
                                            📁 {{ $category->name }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif

                            <div class="post-excerpt">
                                {{ Str::limit($post->content, 120) }}
                            </div>

                            @if($post->tags && $post->tags->count() > 0)
                                <div class="post-tags">
                                    @foreach($post->tags as $postTag)
                                        <a href="{{ route('tags.show', $postTag) }}"
                                           class="post-tag {{ $postTag->id == $tag->id ? 'current' : '' }}">
                                            #{{ $postTag->name }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif

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
                    <div class="empty-state-icon">🏷️</div>
                    <h3>Henüz Post Yok</h3>
                    <p>Bu etikete sahip henüz bir post bulunmuyor.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
