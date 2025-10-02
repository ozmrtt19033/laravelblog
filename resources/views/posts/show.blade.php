@extends('layouts.app')

@section('title', $post->title . ' - Blog')

@section('content')
    <a href="{{ route('posts.index') }}" class="back-link">
        ← Geri Dön
    </a>

    <div class="post-detail">
        <div class="post-detail-header">
            <h1 class="post-detail-title">{{ $post->title }}</h1>

            <div class="header-actions">
                <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning">✏️ Düzenle</a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="delete-form" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">🗑️ Sil</button>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                ✅ {{ session('success') }}
            </div>
        @endif

        <div class="post-detail-meta">
            <span>👤 {{ $post->user->name ?? 'Anonim' }}</span>
            <span>📅 {{ $post->created_at->format('d.m.Y H:i') }}</span>
            <span>🕒 Güncelleme: {{ $post->updated_at->format('d.m.Y H:i') }}</span>
        </div>

        <div class="post-detail-content">
            {!! nl2br(e($post->content)) !!}
        </div>

        <div class="post-detail-footer">
            <a href="{{ route('posts.index') }}" class="btn btn-primary">← Tüm Postlar</a>
        </div>
    </div>
@endsection

