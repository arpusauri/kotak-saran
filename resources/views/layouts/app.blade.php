<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Kotak Saran') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-vh-100 bg-gray-100">
            <!-- Navigation -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ route('suggestions.index') }}">
                        📬 Kotak Saran
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('suggestions.create') }}">
                                    ➕ Submit Suggestion
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('suggestions.index') }}">
                                    📋 View Suggestions
                                </a>
                            </li>

                            @auth
                                @if(auth()->user()->is_admin)
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.suggestions.list') }}">
                                            👨‍💼 Admin Dashboard
                                        </a>
                                    </li>
                                @endif
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                        {{ auth()->user()->name }}
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                                👤 Profile
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="dropdown-item">
                                                    🚪 Logout
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        🔐 Login
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">
                                        📝 Register
                                    </a>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="bg-dark text-white text-center py-4 mt-5">
                <div class="container">
                    <p class="mb-0">&copy; {{ date('Y') }} Kotak Saran. All rights reserved.</p>
                </div>
            </footer>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    </body>
</html>