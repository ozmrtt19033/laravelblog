<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        /* Navigation Styles */
        .top-nav {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-link {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: opacity 0.3s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-link:hover {
            opacity: 0.8;
        }

        .user-section {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            color: white;
        }

        .user-name {
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logout-btn {
            background: rgba(255,255,255,0.2);
            color: white;
            border: 2px solid white;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logout-btn:hover {
            background: white;
            color: #667eea;
            transform: translateY(-2px);
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                gap: 1rem;
            }

            .nav-links {
                flex-direction: column;
                gap: 1rem;
            }

            .user-section {
                flex-direction: column;
                gap: 0.5rem;
            }
        }
    </style>
</head>
<body class="font-sans antialiased">
<!-- Navigation Bar -->
<nav class="top-nav">
    <div class="nav-container">
        <a href="{{ route('dashboard') }}" class="nav-brand">
            🚀 {{ config('app.name', 'Laravel') }}
        </a>

        <div class="nav-links">
            <a href="{{ route('dashboard') }}" class="nav-link">
                📊 Dashboard
            </a>
            <a href="{{ route('posts.index') }}" class="nav-link">
                📝 Posts
            </a>
            <a href="{{ route('posts.create') }}" class="nav-link">
                ✨ Yeni Post
            </a>
        </div>

        <div class="user-section">
                <span class="user-name">
                    👤 {{ Auth::user()->name }}
                </span>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">
                    🚪 Çıkış Yap
                </button>
            </form>
        </div>
    </div>
</nav>

<!-- Page Content -->
<main>
    @yield('content')
</main>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
