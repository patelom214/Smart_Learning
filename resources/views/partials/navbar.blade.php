<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">

        <!-- Brand -->
       <a href="{{ url('/') }}"
   class="navbar-brand d-flex align-items-center gap-2 text-decoration-none p-0">

  <!-- Graduation Cap Icon -->
  <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
    <defs>
      <linearGradient id="slLogo" x1="0" y1="0" x2="1" y2="1">
        <stop offset="0%" stop-color="#3b82f6"/>
        <stop offset="100%" stop-color="#0d6efd"/>
      </linearGradient>
    </defs>
    <!-- Icon background rounded square -->
    <rect width="32" height="32" rx="8" fill="url(#slLogo)"/>
    <!-- Cap board -->
    <polygon points="16,6 28,12 16,18 4,12" fill="white"/>
    <!-- Stand -->
    <line x1="16" y1="18" x2="16" y2="27" stroke="white" stroke-width="2" stroke-linecap="round"/>
    <!-- Base -->
    <rect x="10" y="26" width="12" height="3.5" rx="1.75" fill="white"/>
    <!-- Tassel cord -->
    <line x1="28" y1="12" x2="28" y2="22" stroke="rgba(255,255,255,0.7)" stroke-width="1.5" stroke-linecap="round"/>
    <!-- Tassel end -->
    <circle cx="28" cy="24" r="2" fill="rgba(255,255,255,0.7)"/>
  </svg>

  <!-- Wordmark -->
  <span style="font-size:1.05rem;line-height:1;">
    <span style="font-weight:800;color:#0d6efd;letter-spacing:-0.4px;">Smart</span><span style="font-weight:400;color:#1c1e21;letter-spacing:-0.3px;">  Learn</span>
  </span>

</a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Content -->
        <div class="collapse navbar-collapse" id="mainNavbar">
            @php
            $minimalRoutes = ['login', 'register', 'password.request', 'password.reset', 'welcome'];
            @endphp

            @if(auth()->check() || !in_array(Route::currentRouteName(), $minimalRoutes))
            <!-- Center Menu -->
            <ul class="navbar-nav mx-auto text-center mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('feed') ? 'active' : '' }}" href="{{ route('feed') }}">
                        Discover
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('friends.index') ? 'active' : '' }}" href="{{ route('friends.index') }}">
                        Friends
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle growth-link" href="#"
                        id="growthDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Growth
                    </a>

                    <ul class="dropdown-menu growth-dropdown shadow border-0" aria-labelledby="growthDropdown">
                        <li>
                            <a class="dropdown-item growth-item {{ request()->routeIs('skills.skill') ? 'active' : '' }}" href="{{ route('skills.skill') }}">
                                <i class="bi bi-lightning-charge me-2"></i> Skills
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item growth-item {{ request()->routeIs('roadmap.index') ? 'active' : '' }}" href="{{ route('roadmap.index') }}">
                                <i class="bi bi-map me-2"></i> Roadmap
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
            @endif

            <!-- Right Side Actions -->
            <div class="d-flex align-items-center gap-3 ms-auto">
                @if(auth()->check())
                <a href="{{ route('feed') }}" class="btn btn-primary">
                    + Create
                </a>

                <!-- Notification Dropdown -->
                @auth
                @php
                $unreadCount = $notifications->count();
                @endphp

                <div class="position-relative">
    <a href="{{ route('notifications') }}" class="nav-link">
        <i class="bi bi-bell fs-5"></i>

        @if($unreadCount > 0)
            <span class="position-absolute top-0 start-100 translate-middle 
                         badge rounded-pill bg-danger">
                {{ $unreadCount }}
            </span>
        @endif
    </a>
</div>
                @endauth

                <!-- Profile Dropdown -->
                <div class="dropdown">
                    <a class="d-flex align-items-center gap-2 text-decoration-none px-2 py-1 rounded-pill hover-bg"
                        href="#" data-bs-toggle="dropdown">

                        @if(auth()->user()->profile_photo)
                        <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
                            width="36" height="36"
                            class="rounded-circle border object-fit-cover shadow-sm">
                        @else
                        <div class="d-flex align-items-center justify-content-center 
                    rounded-circle border bg-light shadow-sm"
                            style="width:36px;height:36px;">
                            <i class="bi bi-person-fill fs-5 text-secondary"></i>
                        </div>
                        @endif

                        <span class="fw-semibold text-dark">
                            {{ auth()->user()->name }}
                        </span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-4 p-2"
                        style="min-width: 220px;">

                        <!-- User Info -->
                        <li class="px-3 py-2 border-bottom">
                            <div class="fw-semibold">{{ auth()->user()->name }}</div>
                            <small class="text-muted">{{ auth()->user()->email }}</small>
                        </li>

                        <!-- Menu Items -->
                        <li>
                            <a class="dropdown-item rounded-3 d-flex align-items-center gap-2"
                                href="{{ route('profile.show', ['user' => auth()->user()->id]) }}">
                                <i class="bi bi-person"></i> View Profile
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item rounded-3 d-flex align-items-center gap-2"
                                href="{{ route('profile.edit', auth()->user()->id) }}">
                                <i class="bi bi-pencil-square"></i> Edit Profile
                            </a>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item text-danger rounded-3 d-flex align-items-center gap-2">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>


                @else
                <!-- Guest: Login / Sign Up -->
                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm me-2">Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Sign Up</a>
                @endif
            </div>
        </div>
    </div>
    <style>
        .hover-bg:hover {
            background-color: #f8f9fa;
        }

        .notification-icon {
            position: relative;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #667eea;
            background: rgba(102, 126, 234, 0.1);
            transition: all 0.3s ease;
            font-size: 1.2rem;
        }

        .notification-icon:hover {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            transform: translateY(-2px);
        }

        .notification-badge {
            position: absolute;
            top: 4px;
            right: 4px;
            background: #ff4d4f;
            color: white;
            font-size: 10px;
            font-weight: 600;
            padding: 3px 6px;
            border-radius: 20px;
            line-height: 1;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }
    </style>
</nav>