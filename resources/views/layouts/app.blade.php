<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
  <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <title>@yield('title', 'Smart Learning Platform')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">


    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(120deg, #e0f2ff, #f3e8ff);
            min-height: 100vh;
        }

        .main-content {
            min-height: calc(100vh - 120px);
        }

        footer {
            background: #ffffff;
            border-top: 1px solid #e5e7eb;
        }
    </style>

    @stack('styles')
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Page Content -->
    <main class="flex-fill">
        @yield('content')
    </main>

    <!-- Footer -->
   @if(!request()->routeIs(['login', 'register', 'welcome', 'password.request']))
    @include('partials.footer')
@endif

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>

</html>