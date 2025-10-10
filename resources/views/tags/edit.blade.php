@extends('layouts.app')

@section('content')
    <style>
        .edit-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .header {
            margin-bottom: 2rem;
        }

        .header h1 {
            font-size: 2rem;
            font-weight: 700;
            color: #1f2937;
            margin: 0 0 0.5rem 0;
        }

        .header p {
            color: #6b7280;
            font-size: 1rem;
        }

        .form-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .form-label .required {
            color: #ef4444;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
            box-sizing: border-box;
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        textarea.form-control {
            min-height: 150px;
            resize: vertical;
            font-family: inherit;
            line-height: 1.5;
        }

        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .form-control.is-invalid {
            border-color: #ef4444;
            background-color: #fef2f2;
        }

        .alert {
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        .alert-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            box-shadow: 0 4px 6px rgba(239, 68, 68, 0.2);
        }

        .alert-danger ul {
            margin: 0.5rem 0 0 1.5rem;
            padding: 0;
        }

        .alert-danger li {
            margin: 0.25rem 0;
        }

        .alert-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            box-shadow: 0 4px 6px rgba(245, 158, 11, 0.2);
            margin-top: 1rem;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .btn {
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            text-decoration: none;
            display: inline-block;
            text-align: center;
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

        .btn-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            box-shadow: 0 2px 4px rgba(239, 68, 68, 0.3);
            width: 100%;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(239, 68, 68, 0.4);
        }

        .help-text {
            color: #6b7280;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .info-box {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            border-left: 4px solid #f59e0b;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .info-box p {
            margin: 0;
            color: #92400e;
            font-size: 0.9rem;
            line-height: 1.6;
        }

        .stats-box {
            background: linear-gradient(135deg, #e0e7ff 0%, #ddd6fe 100%);
            padding: 1.5rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .stat-item {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .stat-label {
            color: #4c1d95;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .stat-value {
            color: #5b21b6;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .delete-section {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border: 2px solid #fee2e2;
        }

        .slug-preview {
            background: #f3f4f6;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            margin-top: 0.5rem;
            font-family: monospace;
            font-size: 0.875rem;
            color: #6b7280;
        }

        .slug-preview strong {
            color: #667eea;
        }

        @media (max-width: 768px) {
            .edit-container {
                padding: 0 1rem;
            }

            .form-card, .delete-section {
                padding: 1.5rem;
            }

            .header h1 {
                font-size: 1.5rem;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }

            .stats-box {
                gap: 1rem;
            }
        }
    </style>

    <div class="edit-container">
        <div class="header">
            <h1>#️⃣ Etiket Düzenle</h1>
            <p>"{{ $tag->name }}" etiketini düzenleyin</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                ⚠️ <strong>Hata!</strong> Lütfen aşağıdaki hataları düzeltin:
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-card">
            <!-- İstatistikler -->
            <div class="stats-box">
                <div class="stat-item">
                    <span class="stat-label">📊 Kullanım Sayısı</span>
                    <span class="stat-value">{{ $tag->posts->count() }} Post</span>
                </div>
                @if($tag->created_at)
                    <div class="stat-item">
                        <span class="stat-label">📅 Oluşturulma</span>
                        <span class="stat-value">{{ $tag->created_at->format('d.m.Y') }}</span>
                    </div>
                @endif
                @if($tag->updated_at && $tag->updated_at != $tag->created_at)
                    <div class="stat-item">
                        <span class="stat-label">🔄 Son Güncelleme</span>
                        <span class="stat-value">{{ $tag->updated_at->format('d.m.Y') }}</span>
                    </div>
                @endif
            </div>

            @if($tag->posts->count() > 0)
                <div class="info-box">
                    <p>
                        💡 <strong>Bilgi:</strong> Bu etiket {{ $tag->posts->count() }} adet postta kullanılıyor.
                        Etiket adını değiştirirseniz, tüm postlarda otomatik olarak güncellenecektir.
                    </p>
                </div>
            @endif

            <form action="{{ route('tags.update', $tag) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name" class="form-label">
                        🏷️ Etiket Adı <span class="required">*</span>
                    </label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $tag->name) }}"
                        placeholder="Örn: Laravel, React, Yapay Zeka..."
                        required
                        autofocus
                    >
                    @error('name')
                    <div class="error-message">
                        ⚠️ {{ $message }}
                    </div>
                    @enderror
                    <div class="help-text">
                        💡 Etiketinize kısa ve öz bir isim verin. Genellikle tek kelime veya kısa ifadeler tercih edilir.
                    </div>
                </div>

                <div class="form-group">
                    <label for="slug" class="form-label">
                        🔗 Slug (URL'de Görünecek İsim)
                    </label>
                    <input
                        type="text"
                        name="slug"
                        id="slug"
                        class="form-control @error('slug') is-invalid @enderror"
                        value="{{ old('slug', $tag->slug) }}"
                        placeholder="laravel, yapay-zeka..."
                    >
                    @error('slug')
                    <div class="error-message">
                        ⚠️ {{ $message }}
                    </div>
                    @enderror
                    <div class="slug-preview">
                        Mevcut URL: <strong>{{ url('/tags/' . $tag->slug) }}</strong>
                    </div>
                    <div class="help-text">
                        💡 Etiket adından otomatik oluşturulur. Özel bir URL istiyorsanız değiştirebilirsiniz.
                    </div>
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">
                        📄 Açıklama
                    </label>
                    <textarea
                        name="description"
                        id="description"
                        class="form-control @error('description') is-invalid @enderror"
                        placeholder="Bu etiket hangi konuları kapsıyor? Kısa bir açıklama yazın..."
                    >{{ old('description', $tag->description) }}</textarea>
                    @error('description')
                    <div class="error-message">
                        ⚠️ {{ $message }}
                    </div>
                    @enderror
                    <div class="help-text">
                        💡 Etiketinizin içeriğini tanımlayan kısa bir metin (İsteğe bağlı).
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        💾 Değişiklikleri Kaydet
                    </button>
                    <a href="{{ route('tags.index') }}" class="btn btn-secondary">
                        ← Geri Dön
                    </a>
                </div>
            </form>
        </div>

        <!-- Silme Bölümü (Ayrı Form) -->
        <div class="delete-section">
            <h3 style="color: #dc2626; margin: 0 0 1rem 0; font-size: 1.25rem;">
                🗑️ Tehlikeli Bölge
            </h3>

            @if($tag->posts->count() === 0)
                <p style="color: #6b7280; margin-bottom: 1rem;">
                    Bu etiketi kalıcı olarak silebilirsiniz. Bu işlem geri alınamaz!
                </p>
                <form action="{{ route('tags.destroy', $tag) }}" method="POST" onsubmit="return confirm('Bu etiketi silmek istediğinize emin misiniz? Bu işlem geri alınamaz!')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        🗑️ Etiketi Kalıcı Olarak Sil
                    </button>
                </form>
            @else
                <div class="alert alert-warning">
                    ⚠️ <strong>Bu etiket silinemez!</strong>
                    <ul style="margin: 0.5rem 0 0 1.5rem; padding: 0;">
                        <li>{{ $tag->posts->count() }} adet postta kullanılıyor</li>
                    </ul>
                    <p style="margin: 0.5rem 0 0 0;">
                        Silmek için önce bu etiketi kullanan postlardan kaldırmalısınız.
                    </p>
                </div>
            @endif
        </div>
    </div>

    <script>
        // Etiket adından otomatik slug oluşturma
        document.getElementById('name').addEventListener('input', function(e) {
            const slugInput = document.getElementById('slug');

            // Sadece slug manuel değiştirilmemişse otomatik oluştur
            if (slugInput.dataset.manuallyEdited !== 'true') {
                let slug = e.target.value
                    .toLowerCase()
                    .trim()
                    .replace(/ğ/g, 'g')
                    .replace(/ü/g, 'u')
                    .replace(/ş/g, 's')
                    .replace(/ı/g, 'i')
                    .replace(/ö/g, 'o')
                    .replace(/ç/g, 'c')
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-')
                    .replace(/^-+|-+$/g, '');

                slugInput.value = slug;
            }
        });

        // Slug manuel değiştirilirse otomatik oluşturmayı durdur
        document.getElementById('slug').addEventListener('input', function(e) {
            e.target.dataset.manuallyEdited = 'true';
        });

        // Form submit olurken slug'ı temizle
        document.querySelector('form').addEventListener('submit', function(e) {
            const slugInput = document.getElementById('slug');
            if (slugInput.value) {
                slugInput.value = slugInput.value
                    .toLowerCase()
                    .trim()
                    .replace(/[^a-z0-9-]/g, '')
                    .replace(/-+/g, '-')
                    .replace(/^-+|-+$/g, '');
            }
        });
    </script>
@endsection
