<?php use Illuminate\Support\Facades\Auth;
$user = Auth::user();
?>
<!doctype html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{url('css/pages/admin/global.css')}}"/>
    @yield('page-css')
  </head>
  <body>
    <!-- Header -->
    <header class="header">
      <div class="header-container">
        <!-- Logo -->
        <a href="/">
        <div class="logo-section">
          <img
            src="https://cdn.builder.io/api/v1/image/assets/TEMP/5029f4236f65d0d4d941d8086f6901a1afaa86c0?width=82"
            alt="صراحة"
            class="logo-img"
          />
          <h1 class="logo-text">صراحة</h1>
        </div>
        </a>
        

      <!-- Notification & User -->
<div class="header-actions">
  <div class="notification-bell">
    <svg
      class="nav-icon"
      viewBox="0 0 24 24"
      fill="none"
      stroke="currentColor"
      stroke-width="2"
    >
      <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
      <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
    </svg>
  </div>

  <div class="user-dropdown">
  <img
    id="userAvatar"
    src="{{url('images/profile.png')}}"
    alt="المستخدم"
    class="user-avatar"
  />
  <div id="dropdownMenu" class="dropdown-menu">
    <p class="username">{{$user->name}}</p>
    <form action="{{route('logout')}}" method="post">
      @csrf
      <input type="submit" value="Logout" class="logout-btn">
    </form>
  </div>
</div>

</div>
      </div>
    </header>


    <div class="main-container">
    <!-- Sidebar -->
      <div class="sidebar">
        <div class="sidebar-content">
          <nav>
            <a href="{{route('admin.index')}}"><div class="nav-item {{ request()->routeIs('admin.index') ? 'active' : '' }}">
            <svg
                class="nav-icon"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
              >
                <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8" />
                <path
                  d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"
                />
              </svg>
              <span>لوحة التحكم</span>
            </div></a>
            
            <a href="{{route('admin.users')}}">
              <div class="nav-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
              <svg
                class="nav-icon"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
              >
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
              </svg>
              <span>المستخدمون</span>
            </div>
            </a>
            
            <a href="{{route('admin.messages')}}">
            <div class="nav-item {{ request()->routeIs('admin.messages') ? 'active' : '' }}">
              <svg
                class="nav-icon"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
              >
                <path
                  d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"
                />
                <polyline points="22,6 12,13 2,6" />
              </svg>
              <span>الرسائل</span>
            </div>
            </a>
            
            <a href="{{route('admin.reports')}}">
 <div class="nav-item {{ request()->routeIs('admin.reports') ? 'active' : '' }}">
              <svg
                class="nav-icon"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
              >
                <path
                  d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"
                />
                <line x1="4" y1="22" x2="4" y2="15" />
              </svg>
              <span>التقارير</span>
            </div>
            </a>
           
            <a href="{{route('admin.ads')}}">
 <div class="nav-item {{ request()->routeIs('admin.ads') ? 'active' : '' }}">
              <svg
                class="nav-icon"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
              >
                <polygon points="22,3 2,3 10,12.46 10,19 14,21 14,12.46 22,3" />
              </svg>
              <span>الإعلانات</span>
            </div>
            </a>
           
            <a href="{{route('admin.posts')}}">
          <div class="nav-item {{ request()->routeIs('admin.posts') ? 'active' : '' }}">
              <svg
                class="nav-icon"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
              >
                <path
                  d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"
                />
                <polyline points="14,2 14,8 20,8" />
                <line x1="16" y1="13" x2="8" y2="13" />
                <line x1="16" y1="17" x2="8" y2="17" />
                <polyline points="10,9 9,9 8,9" />
              </svg>
              <span>المقالات</span>
            </div>
            </a>
            
            <a href="{{route('admin.settings')}}"><div class="nav-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}-item">
              <svg
                class="nav-icon"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
              >
                <circle cx="12" cy="12" r="3" />
                <path
                  d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"
                />
              </svg>
              <span>الإعدادات</span>
            </div></a>
            

          </nav>
        </div>
      </div>
    @yield('main')
        </div>
        <script>document.addEventListener('DOMContentLoaded', function() {
  const avatar = document.getElementById('userAvatar');
  const menu = document.getElementById('dropdownMenu');
  let isMenuOpen = false;

  // عند النقر على الصورة
  avatar.addEventListener('click', function(event) {
    event.stopPropagation();
    isMenuOpen = !isMenuOpen;
    menu.style.display = isMenuOpen ? 'block' : 'none';
  });

  // عند تمرير الماوس (hover) على الصورة
  avatar.addEventListener('mouseenter', function() {
    menu.style.display = 'block';
    isMenuOpen = true;
  });

  // عند تحريك الماوس خارج الصورة والقائمة
  avatar.addEventListener('mouseleave', function() {
    // نتحقق إن الماوس لم يدخل القائمة نفسها
    setTimeout(() => {
      if (!menu.matches(':hover')) {
        menu.style.display = 'none';
        isMenuOpen = false;
      }
    }, 100);
  });

  // عند تحريك الماوس خارج القائمة
  menu.addEventListener('mouseleave', function() {
    menu.style.display = 'none';
    isMenuOpen = false;
  });

  // عند النقر داخل القائمة نفسها لا تُغلق
  menu.addEventListener('click', function(event) {
    event.stopPropagation();
  });

  // عند النقر خارج القائمة والصورة تغلق
  document.addEventListener('click', function() {
    if (isMenuOpen) {
      menu.style.display = 'none';
      isMenuOpen = false;
    }
  });
});
</script>
    </body>
    </html>
