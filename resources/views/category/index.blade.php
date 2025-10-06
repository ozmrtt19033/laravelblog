@extends('layouts.app')

@section('content')
    <style>
        /* Container */
        .categories-container {
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

        /* Categories List */
        .categories-list {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        /* Parent Category */
        .parent-category {
            margin-bottom: 1.5rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s;
        }

        .parent-category:hover {
            border-color: #667eea;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.1);
        }

        .parent-category-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            user-select: none;
        }

        .parent-category-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex: 1;
        }

        .parent-category-name {
            font-size: 1.25rem;
            font-weight: 700;
            color: white;
            margin: 0;
        }

        .parent-category-meta {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.875rem;
        }

        .parent-category-actions {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .toggle-icon {
            color: white;
            font-size: 1.5rem;
            transition: transform 0.3s;
        }

        .toggle-icon.open {
            transform: rotate(180deg);
        }

        /* Sub Categories */
        .sub-categories {
            background: #f9fafb;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .sub-categories.open {
            max-height: 2000px;
            transition: max-height 0.5s ease-in;
        }

        .sub-category-item {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background 0.2s;
        }

        .sub-category-item:last-child {
            border-bottom: none;
        }

        .sub-category-item:hover {
            background: #f3f4f6;
        }

        .sub-category-info {
            flex: 1;
            padding-left: 2rem;
            position: relative;
        }

        .sub-category-info::before {
            content: "└─";
            position: absolute;
            left: 0.5rem;
            color: #9ca3af;
        }

        .sub-category-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1f2937;
            margin: 0 0 0.25rem 0;
        }

        .sub-category-meta {
            color: #6b7280;
            font-size: 0.875rem;
        }

        .sub-category-description {
            color: #6b7280;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        /* Category Actions */
        .category-actions {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .delete-form {
            display: inline;
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
        }

        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.8rem;
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

        .btn-white {
            background: white;
            color: #667eea;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-white:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
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

        .no-subcategories {
            text-align: center;
            padding: 2rem;
            color: #9ca3af;
            font-style: italic;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .categories-container {
                padding: 0 1rem;
            }

            .categories-list {
                padding: 1rem;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .header h1 {
                font-size: 1.5rem;
            }

            .parent-category-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .parent-category-actions {
                width: 100%;
                justify-content: flex-start;
            }

            .sub-category-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .category-actions {
                width: 100%;
            }

            .btn {
                flex: 1;
                text-align: center;
            }
        }
    </style>

    <div class="categories-container">
        <div class="header">
            <h1>🏷️ Kategoriler</h1>
            <a href="{{ route('category.create') }}" class="btn btn-primary">✨ Yeni Kategori Ekle</a>
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

        @php
            $parentCategories = $categories->where('parent_id', null);
        @endphp

        @if($parentCategories->count() > 0)
            <div class="categories-list">
                @foreach($parentCategories as $parent)
                    <div class="parent-category">
                        <div class="parent-category-header" onclick="toggleSubCategories({{ $parent->id }})">
                            <div class="parent-category-info">
                                <div>
                                    <h2 class="parent-category-name">{{ $parent->name }}</h2>
                                    <div class="parent-category-meta">
                                        📊 {{ $parent->posts_count ?? 0 }} Post
                                        @php
                                            $subCount = $categories->where('parent_id', $parent->id)->count();
                                        @endphp
                                        @if($subCount > 0)
                                            | 📁 {{ $subCount }} Alt Kategori
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="parent-category-actions" onclick="event.stopPropagation()">
                                <a href="{{ route('category.show', $parent) }}" class="btn btn-white btn-sm">👁️ Görüntüle</a>
                                <a href="{{ route('category.edit', $parent) }}" class="btn btn-white btn-sm">✏️ Düzenle</a>
                                <form action="{{ route('category.destroy', $parent) }}" method="POST" class="delete-form" onsubmit="return confirm('Bu kategoriyi silmek istediğinize emin misiniz?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">🗑️ Sil</button>
                                </form>
                                <span class="toggle-icon" id="toggle-{{ $parent->id }}">▼</span>
                            </div>
                        </div>

                        @php
                            $subCategories = $categories->where('parent_id', $parent->id);
                        @endphp

                        <div class="sub-categories" id="sub-{{ $parent->id }}">
                            @if($subCategories->count() > 0)
                                @foreach($subCategories as $sub)
                                    <div class="sub-category-item">
                                        <div class="sub-category-info">
                                            <h3 class="sub-category-name">{{ $sub->name }}</h3>
                                            <div class="sub-category-meta">
                                                📊 {{ $sub->posts_count ?? 0 }} Post
                                            </div>
                                            @if($sub->description)
                                                <div class="sub-category-description">
                                                    {{ Str::limit($sub->description, 100) }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="category-actions">
                                            <a href="{{ route('category.show', $sub) }}" class="btn btn-primary btn-sm">👁️ Görüntüle</a>
                                            <a href="{{ route('category.edit', $sub) }}" class="btn btn-warning btn-sm">✏️ Düzenle</a>
                                            <form action="{{ route('category.destroy', $sub) }}" method="POST" class="delete-form" onsubmit="return confirm('Bu alt kategoriyi silmek istediğinize emin misiniz?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">🗑️ Sil</button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="no-subcategories">
                                    Alt kategori bulunmuyor
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <h2>📭 Henüz Kategori Yok</h2>
                <p>İlk kategorinizi oluşturmak için butona tıklayın!</p>
                <a href="{{ route('category.create') }}" class="btn btn-primary">✨ İlk Kategoriyi Oluştur</a>
            </div>
        @endif
    </div>

    <script>
        function toggleSubCategories(categoryId) {
            const subCategories = document.getElementById('sub-' + categoryId);
            const toggleIcon = document.getElementById('toggle-' + categoryId);

            if (subCategories.classList.contains('open')) {
                subCategories.classList.remove('open');
                toggleIcon.classList.remove('open');
            } else {
                subCategories.classList.add('open');
                toggleIcon.classList.add('open');
            }
        }
    </script>
@endsection
