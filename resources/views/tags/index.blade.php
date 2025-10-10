@extends('layouts.app')

@section('content')
    <style>
        /* Container */
        .tags-container {
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

        .alert-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            box-shadow: 0 4px 6px rgba(239, 68, 68, 0.2);
        }

        /* Tags Grid */
        .tags-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        /* Tag Card */
        .tag-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .tag-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .tag-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(102, 126, 234, 0.2);
            border-color: #667eea;
        }

        .tag-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .tag-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            flex-shrink: 0;
        }

        .tag-name {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1f2937;
            margin: 0 0 0.5rem 0;
            flex: 1;
            padding-left: 1rem;
        }

        .tag-slug {
            background: #f3f4f6;
            color: #6b7280;
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-family: monospace;
            margin-bottom: 1rem;
            display: inline-block;
        }

        .tag-description {
            color: #6b7280;
            font-size: 0.875rem;
            line-height: 1.5;
            margin-bottom: 1rem;
            min-height: 2.5rem;
        }

        .tag-meta {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #e5e7eb;
            margin-bottom: 1rem;
        }

        .tag-stat {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #6b7280;
            font-size: 0.875rem;
        }

        .tag-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0.375rem 0.75rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.875rem;
        }

        /* Tag Actions */
        .tag-actions {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .delete-form {
            display: inline;
            flex: 1;
        }

        /* Buttons */
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-sm {
            padding: 0.5rem 0.875rem;
            font-size: 0.8rem;
            flex: 1;
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

        .empty-state-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
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
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .tags-container {
                padding: 0 1rem;
            }

            .tags-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .header h1 {
                font-size: 1.5rem;
            }

            .tag-card {
                padding: 1rem;
            }

            .tag-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .tag-name {
                padding-left: 0;
                margin-top: 0.5rem;
            }

            .tag-actions {
                width: 100%;
            }

            .btn-sm {
                padding: 0.625rem 1rem;
            }
        }
    </style>

    <div class="tags-container">
        <div class="header">
            <h1>🏷️ Etiketler</h1>
            <a href="{{ route('tags.create') }}" class="btn btn-primary">✨ Yeni Etiket Ekle</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                ⚠️ {{ session('error') }}
            </div>
        @endif

        @if($tags->count() > 0)
            <div class="tags-grid">
                @foreach($tags as $tag)
                    <div class="tag-card">
                        <div class="tag-header">
                            <div class="tag-icon">
                                #️⃣
                            </div>
                        </div>

                        <h2 class="tag-name">{{ $tag->name }}</h2>

                        <div class="tag-slug">{{ $tag->slug }}</div>

                        @if($tag->description)
                            <div class="tag-description">
                                {{ Str::limit($tag->description, 100) }}
                            </div>
                        @else
                            <div class="tag-description" style="color: #d1d5db; font-style: italic;">
                                Açıklama eklenmemiş
                            </div>
                        @endif

                        <div class="tag-meta">
                            <div class="tag-stat">
                                <span>📊</span>
                                <span class="tag-badge">{{ $tag->posts_count ?? 0 }} Post</span>
                            </div>
                        </div>

                        <div class="tag-actions">
                            <a href="{{ route('tags.edit', $tag) }}" class="btn btn-warning btn-sm">
                                ✏️ Düzenle
                            </a>
                            <form action="{{ route('tags.destroy', $tag) }}" method="POST" class="delete-form" onsubmit="return confirm('Bu etiketi silmek istediğinize emin misiniz?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    🗑️ Sil
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            @if(method_exists($tags, 'hasPages') && $tags->hasPages())
                <div class="pagination-wrapper">
                    {{ $tags->links() }}
                </div>
            @endif
        @else
            <div class="empty-state">
                <div class="empty-state-icon">🏷️</div>
                <h2>Henüz Etiket Yok</h2>
                <p>İlk etiketinizi oluşturmak için butona tıklayın!</p>
                <a href="{{ route('tags.create') }}" class="btn btn-primary">✨ İlk Etiketi Oluştur</a>
            </div>
        @endif
    </div>
@endsection
