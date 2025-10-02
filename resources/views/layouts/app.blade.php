<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog')</title>
    <link rel="stylesheet" href="{{ asset('css/posts.css') }}">
    <style>
        body {
            margin: 0;
            padding: 0;
        }
        .form-container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            max-width: 800px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            color: #374151;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 1rem;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        textarea,
        select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        textarea {
            resize: vertical;
            min-height: 200px;
        }

        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 5px;
        }

        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
        }

        .btn-secondary:hover {
            background: #4b5563;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: white;
            text-decoration: none;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            transform: translateX(-5px);
        }
    </style>
    @stack('styles')
</head>
<body>
<div class="container">
    @yield('content')
</div>

<script src="{{ asset('js/posts.js') }}"></script>
@stack('scripts')
</body>
</html>
