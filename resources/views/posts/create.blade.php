@extends('layouts.app')

@section('content')
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        /* Container Styles */
        .create-container {
            max-width: 800px;
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

        /* Page Header */
        .page-header {
            margin-bottom: 2rem;
        }

        .page-header h1 {
            font-size: 2rem;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
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
        }

        /* Form Card */
        .form-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            padding: 2rem;
        }

        /* Form Groups */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .form-input,
        .form-textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
            font-family: inherit;
            box-sizing: border-box;
        }

        .form-input:focus,
        .form-textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-textarea {
            min-height: 200px;
            resize: vertical;
        }

        /* Select2 Custom Styling */
        .select2-container--default .select2-selection--multiple {
            border: 2px solid #e5e7eb !important;
            border-radius: 8px !important;
            min-height: 45px !important;
            padding: 0.25rem 0.5rem !important;
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: #667eea !important;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1) !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            border: none !important;
            color: white !important;
            border-radius: 6px !important;
            padding: 0.35rem 0.75rem !important;
            margin: 0.25rem !important;
            font-weight: 500 !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: white !important;
            margin-right: 0.5rem !important;
            font-weight: bold !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
            color: #fee !important;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background: #667eea !important;
        }

        .select2-container--default .select2-search--inline .select2-search__field {
            font-family: inherit !important;
            padding: 0.25rem !important;
        }

        .select2-dropdown {
            border: 2px solid #e5e7eb !important;
            border-radius: 8px !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1) !important;
        }

        .section-helper {
            color: #6b7280;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: block;
        }

        /* Character Counter */
        .char-counter {
            text-align: right;
            color: #6b7280;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        /* Error Message */
        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .error-message::before {
            content: "⚠️";
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
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
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

        .btn-secondary {
            background: #f3f4f6;
            color: #6b7280;
        }

        .btn-secondary:hover {
            background: #e5e7eb;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .create-container {
                padding: 0 1rem;
            }

            .form-card {
                padding: 1.5rem;
            }

            .page-header h1 {
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
        <a href="{{ route('posts.index') }}" class="back-button">
            ← Geri Dön
        </a>

        <div class="page-header">
            <h1>✨ Yeni Post Oluştur</h1>
        </div>

        @if(session('success'))
            <div class="success-alert">
                <span style="font-size: 1.5rem;">✓</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="form-card">
            <form action="{{ route('posts.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="title">Başlık</label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        class="form-input"
                        value="{{ old('title') }}"
                        placeholder="Harika bir başlık yazın..."
                        required
                    >
                    @error('title')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="body">İçerik</label>
                    <textarea
                        id="body"
                        name="body"
                        class="form-textarea"
                        placeholder="Hikayenizi anlatın..."
                        oninput="updateCharCount(this)"
                        required
                    >{{ old('body') }}</textarea>
                    <div class="char-counter">
                        <span id="char-count">0</span> karakter
                    </div>
                    @error('body')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="category_ids">Kategoriler</label>
                    <select name="category_ids[]" id="category_ids" class="form-select" multiple="multiple" style="width: 100%;">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ in_array($category->id, old('category_ids', [])) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <span class="section-helper">Birden fazla kategori seçebilirsiniz</span>
                    @error('category_ids')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="tag_ids">Etiketler</label>
                    <select name="tag_ids[]" id="tag_ids" class="form-select" multiple="multiple" style="width: 100%;">
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tag_ids', [])) ? 'selected' : '' }}>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                    <span class="section-helper">Birden fazla etiket seçebilirsiniz</span>
                    @error('tag_ids')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        💾 Kaydet
                    </button>
                    <a href="{{ route('posts.index') }}" class="btn btn-secondary">
                        ✕ İptal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- jQuery (Select2 için gerekli) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        function updateCharCount(textarea) {
            const count = textarea.value.length;
            document.getElementById('char-count').textContent = count;
        }

        // Sayfa yüklendiğinde
        $(document).ready(function() {
            // Select2 başlat
            $('#category_ids').select2({
                // placeholder: 'Kategori seçin...',
                allowClear: true,
                language: {
                    noResults: function() {
                        return "Sonuç bulunamadı";
                    }
                }
            });

            $('#tag_ids').select2({
                // placeholder: 'Etiket seçin...',
                allowClear: true,
                language: {
                    noResults: function() {
                        return "Sonuç bulunamadı";
                    }
                }
            });

            // Karakter sayısını güncelle
            const textarea = document.getElementById('body');
            if (textarea && textarea.value) {
                updateCharCount(textarea);
            }
        });
    </script>
@endsection
