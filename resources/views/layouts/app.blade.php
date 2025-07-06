<?php
use App\Models\NavItem;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use App\Models\FooterNavItem;

$settings = Setting::all()->keyBy('key');
$menus = NavItem::where('active', 1)->orderBy('order')->get();
$menus2 = FooterNavItem::where('active', 1)->orderBy('order')->get();

// إذا كان المستخدم مسجل دخول، نحضر بياناته
if(Auth::check()){
    $user = Auth::user();
    $logoUrl = route('user');
    $dashboardUrl = route('user');
    $unreadCount = $user->messages()->whereNull('read_at')->count();
    $unreadItems = $user->messages()->whereNull('read_at')->latest()->take(5)->get();
} else {
    $logoUrl = url('/');
    $dashboardUrl = url('/');
}
?>
<!doctype html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield("title")</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="icon" href="{{url('images/logo.png')}}"/>
  <link rel="stylesheet" href="{{url('css/globalstyle.css')}}">
  <style>
    /* Mobile Menu Styles */
    .menu-toggle {
      display: none;
      background: none;
      border: none;
      cursor: pointer;
      padding: 10px;
      margin-right: 10px;
    }
    
    .nav {
      display: flex;
      transition: all 0.3s ease;
    }
    
    .nav.active {
      display: flex;
      flex-direction: column;
      position: absolute;
      top: 70px;
      right: 0;
      background: white;
      width: 100%;
      padding: 15px;
      box-shadow: 0 5px 10px rgba(0,0,0,0.1);
      z-index: 100;
    }
    
    .nav-item {
      padding: 10px 0;
    }
    
    @media (max-width: 768px) {
      .menu-toggle {
        display: block;
      }
      
      .nav {
        display: none;
      }
      
      .nav.active {
        display: flex;
      }
    }
  </style>
  @yield('page-css')
</head>
<body>
<header class="header">
  <div class="container">
    <div class="header-content">
      <!-- Logo -->
      <a href="/" class="logo">
        <div class="logo">
          <img src="{{ !empty($settings['site_logo']->value) ? asset('uploads/' . $settings['site_logo']->value) : url('images/'.'logo.png') }}" alt="Logo" class="logo-img"/>
          <h1 class="logo-text">{{ !empty($settings['site_title']->value) ? $settings['site_title']->value: 'صراحة' }}</h1>
        </div>
      </a>

      <!-- Navigation - Only show toggle if there are menu items -->
      @if($menus->count() > 0)
        <nav class="nav">
          @foreach($menus as $menu)
            <div class="nav-item">
              {!! $menu->icon !!}
              <a href="{{ $menu->url }}">{{ $menu->title }}</a>
            </div>
          @endforeach
        </nav>
      @endif

      <!-- Auth / User Area -->
      @if(Auth::check())
        @php
          $avatarPath = public_path('avatars/'.$user->avatar);
        @endphp
        <div class="header-actions">
          <!-- User Dropdown -->
          <div class="user-dropdown">
            <a href="{{ $dashboardUrl }}">
              @if($user->avatar && file_exists($avatarPath))
                <img src="{{ asset('avatars/'.$user->avatar) }}" alt="Profile" class="profile-img">
              @else
                <img src="{{ asset('images/profile.png') }}" alt="Profile" class="profile-img">
              @endif
            </a>
            <div class="dropdown-menu">
              <p class="username">{{ $user->name }}</p>
              <form action="{{ route('logout') }}" method="post">@csrf
                <input type="submit" value="تسجيل الخروج" class="logout-btn">
              </form>
            </div>
          </div>

          <!-- Notifications -->
          <div class="notification-wrapper">
            <button class="notification-btn" aria-label="Notifications">
              @if($unreadCount)
                <span class="notif-badge">{{ $unreadCount }}</span>
              @endif
              <svg width="16" height="18" viewBox="0 0 16 18" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M15.3281 12.7453C14.8945 11.9984 14.25 9.88516 14.25 7.125C14.25 3.67322 11.4518 0.875 8 0.875C4.54822 0.875 1.75 3.67322 1.75 7.125C1.75 9.88594 1.10469 11.9984 0.671094 12.7453C0.445722 13.1318 0.444082 13.6092 0.666796 13.9973C0.889509 14.3853 1.30261 14.6247 1.75 14.625H4.93828C5.23556 16.0796 6.51529 17.1243 8 17.1243C9.48471 17.1243 10.7644 16.0796 11.0617 14.625H14.25C14.6972 14.6244 15.1101 14.3849 15.3326 13.9969C15.5551 13.609 15.5534 13.1317 15.3281 12.7453ZM8 15.875C7.20562 15.8748 6.49761 15.3739 6.23281 14.625H9.76719C9.50239 15.3739 8.79438 15.8748 8 15.875ZM1.75 13.375C2.35156 12.3406 3 9.94375 3 7.125C3 4.36358 5.23858 2.125 8 2.125C10.7614 2.125 13 4.36358 13 7.125C13 9.94141 13.6469 12.3383 14.25 13.375H1.75Z"
                  fill="#0D141C"/>
              </svg>
            </button>
            <div class="notification-menu">
              @forelse($unreadItems as $item)
                <div class="notif-item">
                  <div class="notif-avatar"><img src="{{ asset('images/profile.png') }}" alt=""></div>
                  <div class="notif-content">
                    <p class="notif-text">رسالة جديدة من مجهول</p>
                    <span class="notif-time">{{ $item->created_at->diffForHumans() }}</span>
                  </div>
                </div>
              @empty
                <p class="no-notif">لا توجد إشعارات جديدة</p>
              @endforelse
            </div>
          </div>
        </div>
      @else
        <div class="auth-buttons">
          <a href="{{ route('login') }}">
            <div class="auth-item">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                <circle cx="12" cy="8" r="5" fill="#222222"/>
                <path d="M12 15c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" fill="#222222"/>
              </svg>
              <span>دخول</span>
            </div>
          </a>

          <a href="{{ route('register') }}">
            <div class="auth-item">
              <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20 18L14 18M17 15V21M4 21C4 17.134 7.13401 14 11 14C11.695 14 12.3663 14.1013 13 14.2899M15 7C15 9.20914 13.2091 11 11 11C8.79086 11 7 9.20914 7 7C7 4.79086 8.79086 3 11 3C13.2091 3 15 4.79086 15 7Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
              <span>تسجيل</span>
            </div>
          </a>
        </div>
      @endif
      
      <!-- Only show menu toggle if there are menu items -->
      @if($menus->count() > 0)
        <button class="menu-toggle" aria-label="Toggle menu">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M3 6h18M3 12h18M3 18h18" stroke="#0D121C" stroke-width="2" stroke-linecap="round"/>
          </svg>
        </button>
      @endif
    </div>
  </div>
</header>

@yield('main')

<footer class="footer">
  <div class="container">
    <div class="footer-content">
      <div class="footer-links">
        @foreach($menus2 as $menu2)
          <a href="{{ $menu2->url }}"><span>{{ $menu2->title }}</span></a>
        @endforeach
      </div>
      <p class="footer-copyright">جميع الحقوق محفوظة - صراحة © 2025</p>
    </div>
  </div>
</footer>

<script>
// User dropdown functionality
const userDropdown = document.querySelector('.user-dropdown');
if(userDropdown) {
  let timeout;
  userDropdown.addEventListener('mouseenter', () => {
    clearTimeout(timeout);
    userDropdown.querySelector('.dropdown-menu').style.display = 'block';
  });
  userDropdown.addEventListener('mouseleave', () => {
    timeout = setTimeout(() => {
      userDropdown.querySelector('.dropdown-menu').style.display = 'none';
    }, 200);
  });
}

// Notification functionality
const notifWrapper = document.querySelector('.notification-wrapper');
if(notifWrapper) {
  notifWrapper.addEventListener('click', () => {
    const badge = notifWrapper.querySelector('.notif-badge');
    if(badge) {
      badge.style.display = 'none';
    }
  });
}

// Hamburger menu functionality - only if menu exists
const menuToggle = document.querySelector('.menu-toggle');
const nav = document.querySelector('.nav');

if (menuToggle && nav) {
  menuToggle.addEventListener('click', () => {
    nav.classList.toggle('active');
  });
  
  // Close menu when clicking outside
  document.addEventListener('click', (e) => {
    if (!nav.contains(e.target) && !menuToggle.contains(e.target)) {
      nav.classList.remove('active');
    }
  });
}
</script>
</body>
</html>