@extends('layouts.app')

@section('content')
    <style>
        /* Container */
        .create-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        /* Header */
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

        /* Form Card */
        .form-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        /* Form Group */
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

        .form-control, .form-select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
            box-sizing: border-box;
            background: white;
        }

        .form-control:focus, .form-select:focus {
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

        /* Error Messages */
        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .form-control.is-invalid, .form-select.is-invalid {
            border-color: #ef4444;
            background-color: #fef2f2;
        }

        /* Alert */
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

        /* Form Actions */
        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        /* Buttons */
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

        /* Help Text */
        .help-text {
            color: #6b7280;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
        }

        /* Info Box */
        .info-box {
            background: linear-gradient(135deg, #e0e7ff 0%, #ddd6fe 100%);
            border-left: 4px solid #667eea;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .info-box p {
            margin: 0;
            color: #4c1d95;
            font-size: 0.9rem;
            line-height: 1.6;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .create-container {
                padding: 0 1rem;
            }

            .form-card {
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
        }
    </style>

    <div class="create-container">
        <div class="header">
            <h1>🏷️ Yeni Kategori Oluştur</h1>
            <p>Blog içeriklerinizi düzenlemek için yeni bir kategori ekleyin</p>
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
            <div class="info-box">
                <p>
                    💡 <strong>İpucu:</strong> Ana kategoriler temel başlıklar, alt kategoriler ise daha spesifik konular için kullanılır.
                    Örneğin: "Teknoloji" ana kategori, "Yapay Zeka" ve "Mobil Uygulamalar" alt kategoriler olabilir.
                </p>
            </div>

            <form action="{{ route('category.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="parent_id" class="form-label">
                        📁 Üst Kategori
                    </label>
                    <select
                        name="parent_id"
                        id="parent_id"
                        class="form-select @error('parent_id') is-invalid @enderror"
                    >
                        <option value="">🏠 Ana Kategori (Üst kategorisi yok)</option>
                        @foreach($parentCategories as $parent)
                            <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                                📂 {{ $parent->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('parent_id')
                    <div class="error-message">
                        ⚠️ {{ $message }}
                    </div>
                    @enderror
                    <div class="help-text">
                        💡 Bu kategoriyi bir üst kategorinin altına eklemek istiyorsanız yukarıdan seçin. Ana kategori oluşturmak için boş bırakın.
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="form-label">
                        📝 Kategori Adı <span class="required">*</span>
                    </label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}"
                        placeholder="Örn: Teknoloji, Seyahat, Yemek Tarifleri, Spor..."
                        required
                    >
                    @error('name')
                    <div class="error-message">
                        ⚠️ {{ $message }}
                    </div>
                    @enderror
                    <div class="help-text">
                        💡 Kategorinize kısa ve açıklayıcı bir isim verin. Bu isim menülerde ve sayfalarda görünecektir.
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
                        value="{{ old('slug') }}"
                        placeholder="Otomatik oluşturulur... (örn: teknoloji, yemek-tarifleri)"
                    >
                    @error('slug')
                    <div class="error-message">
                        ⚠️ {{ $message }}
                    </div>
                    @enderror
                    <div class="help-text">
                        💡 Boş bırakırsanız kategori adından otomatik oluşturulur. URL'de görüneceği için küçük harf ve tire kullanılır.
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
                        placeholder="Bu kategori hangi konuları içerecek? Kısa bir açıklama yazın..."
                    >{{ old('description') }}</textarea>
                    @error('description')
                    <div class="error-message">
                        ⚠️ {{ $message }}
                    </div>
                    @enderror
                    <div class="help-text">
                        💡 Kategorinizin içeriğini tanımlayan kısa bir metin. Bu açıklama kategori sayfasında ve arama sonuçlarında kullanılabilir (İsteğe bağlı).
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        ✨ Kategori Oluştur
                    </button>
                    <a href="{{ route('category.index') }}" class="btn btn-secondary">
                        ← Geri Dön
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Kategori adından otomatik slug oluşturma
        document.getElementById('name').addEventListener('input', function(e) {
            const slugInput = document.getElementById('slug');

            // Eğer slug inputu boşsa veya otomatik oluşturulmuşsa, yeniden oluştur
            if (!slugInput.value || slugInput.dataset.autoGenerated === 'true') {
                let slug = e.target.value
                    .toLowerCase()
                    .trim()
                    // Türkçe karakterleri dönüştür
                    .replace(/ğ/g, 'g')
                    .replace(/ü/g, 'u')
                    .replace(/ş/g, 's')
                    .replace(/ı/g, 'i')
                    .replace(/ö/g, 'o')
                    .replace(/ç/g, 'c')
                    // Özel karakterleri temizle
                    .replace(/[^a-z0-9\s-]/g, '')
                    // Boşlukları tire ile değiştir
                    .replace(/\s+/g, '-')
                    // Birden fazla tireyi tek tireye çevir
                    .replace(/-+/g, '-')
                    // Baştaki ve sondaki tireleri kaldır
                    .replace(/^-+|-+$/g, '');

                slugInput.value = slug;
                slugInput.dataset.autoGenerated = 'true';
            }
        });

        // Slug manuel değiştirilirse otomatik oluşturmayı durdur
        document.getElementById('slug').addEventListener('input', function(e) {
            if (e.target.value) {
                e.target.dataset.autoGenerated = 'false';
            } else {
                e.target.dataset.autoGenerated = 'true';
            }
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
