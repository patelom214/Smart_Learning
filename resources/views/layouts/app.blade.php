<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,
<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'>
  <defs>
    <linearGradient id='g' x1='0' y1='0' x2='1' y2='1'>
      <stop offset='0%25' stop-color='%233b82f6'/>
      <stop offset='100%25' stop-color='%230d6efd'/>
    </linearGradient>
  </defs>
  <rect width='32' height='32' rx='8' fill='url(%23g)'/>
  <polygon points='16,6 28,12 16,18 4,12' fill='white'/>
  <line x1='16' y1='18' x2='16' y2='27' stroke='white' stroke-width='2' stroke-linecap='round'/>
  <rect x='10' y='26' width='12' height='3.5' rx='1.75' fill='white'/>
  <line x1='28' y1='12' x2='28' y2='22' stroke='rgba(255,255,255,0.7)' stroke-width='1.5' stroke-linecap='round'/>
  <circle cx='28' cy='24' r='2' fill='rgba(255,255,255,0.7)'/>
</svg>" />
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