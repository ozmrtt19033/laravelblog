@extends('layouts.app')

@section('title', $post->title . ' - Blog Görüntüle')

@section('content')
    <style>
        /* Container Styles */
        .detail-container {
            max-width: 900px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        /* Back Button */
        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 1.5rem;
            transition: all 0.3s;
            padding: 0.5rem 1rem;
            border-radius: 8px;
        }

        .back-button:hover {
            background: #f3f4f6;
            transform: translateX(-5px);
        }

        /* Success Alert */
        .success-alert {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: 0 4px 6px rgba(16, 185, 129, 0.2);
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Post Detail Card */
        .post-detail-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        /* Post Header */
        .post-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 2.5rem 2rem;
            color: white;
        }

        .post-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0 0 1.5rem 0;
            line-height: 1.2;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        /* Post Meta */
        .post-meta {
            display: flex;
            gap: 2rem;
            padding: 1.5rem 2rem;
            background: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
            flex-wrap: wrap;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #6b7280;
            font-size: 0.95rem;
        }

        .meta-item strong {
            color: #374151;
        }

        /* Post Content */
        .post-content {
            padding: 2.5rem 2rem;
            font-size: 1.1rem;
            line-height: 1.8;
            color: #374151;
        }

        /* Post Footer */
        .post-footer {
            padding: 1.5rem 2rem;
            background: #f9fafb;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        /* Buttons */
        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            justify-content: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 6px rgba(102, 126, 234, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(102, 126, 234, 0.4);
        }

        .btn-warning {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            color: white;
            box-shadow: 0 4px 6px rgba(251, 191, 36, 0.3);
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(251, 191, 36, 0.4);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            box-shadow: 0 4px 6px rgba(239, 68, 68, 0.3);
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(239, 68, 68, 0.4);
        }

        .btn-secondary {
            background: #f3f4f6;
            color: #6b7280;
        }

        .btn-secondary:hover {
            background: #e5e7eb;
        }

        .delete-form {
            display: inline;
        }

        /* Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .status-published {
            background: #d1fae5;
            color: #065f46;
        }

        .status-draft {
            background: #fee2e2;
            color: #991b1b;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .detail-container {
                padding: 0 1rem;
            }

            .post-header {
                padding: 2rem 1.5rem;
            }

            .post-title {
                font-size: 1.75rem;
            }

            .post-meta {
                flex-direction: column;
                gap: 1rem;
                padding: 1rem 1.5rem;
            }

            .post-content {
                padding: 1.5rem;
                font-size: 1rem;
            }

            .post-footer {
                flex-direction: column;
                align-items: stretch;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>

    <div class="detail-container">
        <a href="{{ route('posts.index') }}" class="back-button">
            ← Geri Dön
        </a>

        @if(session('success'))
            <div class="success-alert">
                <span style="font-size: 1.5rem;">✓</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="post-detail-card">
            <div class="post-header">
                <h1 class="post-title">{{ $post->title }}</h1>

                <div class="action-buttons">
                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning">
                        ✏️ Düzenle
                    </a>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            🗑️ Sil
                        </button>
                    </form>
                </div>
            </div>

            <div class="post-meta">
                <div class="meta-item">
                    <span>👤</span>
                    <strong>{{ $post->user->name ?? 'Anonim' }}</strong>
                </div>
                <div class="meta-item">
                    <span>📅</span>
                    <span>{{ $post->created_at->format('d.m.Y H:i') }}</span>
                </div>
                <div class="meta-item">
                    <span>🕒</span>
                    <span>Güncelleme: {{ $post->updated_at->format('d.m.Y H:i') }}</span>
                </div>
                @if(isset($post->status))
                    <div class="meta-item">
                    <span class="status-badge {{ $post->status === 'published' ? 'status-published' : 'status-draft' }}">
                        {{ $post->status === 'published' ? '🚀 Yayımlandı' : '📝 Taslak' }}
                    </span>
                    </div>
                @endif
            </div>

            <div class="post-content">
                {!! nl2br(e($post->content)) !!}
            </div>

            <div class="post-footer">
                <a href="{{ route('posts.index') }}" class="btn btn-secondary">
                    ← Tüm Postlar
                </a>
                <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary">
                    ✏️ Düzenle
                </a>
            </div>
        </div>
    </div>
@endsection
