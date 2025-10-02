@extends('layouts.app')

@section('content')
    <div class="create-container">
        <a href="{{ route('posts.index') }}" class="back-button">
            ← Geri Dön
        </a>

        <div class="page-header">
            <h1>✏️ Post Düzenle</h1>
        </div>

        @if(session('success'))
            <div class="success-alert">
                <span style="font-size: 1.5rem;">✓</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="form-card">
            <form action="{{ route('posts.update', $post->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label" for="title">Başlık</label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        class="form-input"
                        value="{{ old('title', $post->title) }}"
                        placeholder="Harika bir başlık yazın..."
                        maxlength="255"
                    >
                    @error('title')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="content">İçerik</label>
                    <textarea
                        id="content"
                        name="content"
                        class="form-textarea"
                        placeholder="Hikayenizi anlatın..."
                        oninput="updateCharCount(this)"
                    >{{ old('content', $post->content) }}</textarea>
                    <div class="char-counter">
                        <span id="char-count">0</span> karakter
                    </div>
                    @error('content')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="status">Durum</label>
                    <select id="status" name="status" class="form-select">
                        <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>
                            📝 Taslak
                        </option>
                        <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>
                            🚀 Yayımla
                        </option>
                    </select>
                    @error('status')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        💾 Güncelle
                    </button>
                    <a href="{{ route('posts.index') }}" class="btn btn-secondary">
                        ✕ İptal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function updateCharCount(textarea) {
            const count = textarea.value.length;
            document.getElementById('char-count').textContent = count;
        }

        // Sayfa yüklendiğinde karakter sayısını güncelle
        document.addEventListener('DOMContentLoaded', function() {
            const textarea = document.getElementById('content');
            if (textarea.value) {
                updateCharCount(textarea);
            }
        });
    </script>
@endsection
