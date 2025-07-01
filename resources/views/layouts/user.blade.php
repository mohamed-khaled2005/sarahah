<!doctype html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Noto+Serif:wght@400&display=swap"
      rel="stylesheet"
    />
    @yield('page-css')
  </head>
  <body>
    <div class="container">
      <!-- Header -->
      <header class="header">
        <div class="header-content">
          <!-- Left side - Notification and Profile -->
          <div class="header-left">
            <div class="header-actions">
                 <img
                src="https://cdn.builder.io/api/v1/image/assets/TEMP/015fa293e459dfe000ffdda9c07ca06898cad73e"
                alt="Profile"
                class="profile-img"
              />
              <button class="notification-btn">
                <svg
                  class="icon"
                  xmlns="http://www.w3.org/2000/svg"
                  width="16"
                  height="18"
                  viewBox="0 0 16 18"
                  fill="none"
                >
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M15.3281 12.7453C14.8945 11.9984 14.25 9.88516 14.25 7.125C14.25 3.67322 11.4518 0.875 8 0.875C4.54822 0.875 1.75 3.67322 1.75 7.125C1.75 9.88594 1.10469 11.9984 0.671094 12.7453C0.445722 13.1318 0.444082 13.6092 0.666796 13.9973C0.889509 14.3853 1.30261 14.6247 1.75 14.625H4.93828C5.23556 16.0796 6.51529 17.1243 8 17.1243C9.48471 17.1243 10.7644 16.0796 11.0617 14.625H14.25C14.6972 14.6244 15.1101 14.3849 15.3326 13.9969C15.5551 13.609 15.5534 13.1317 15.3281 12.7453ZM8 15.875C7.20562 15.8748 6.49761 15.3739 6.23281 14.625H9.76719C9.50239 15.3739 8.79438 15.8748 8 15.875ZM1.75 13.375C2.35156 12.3406 3 9.94375 3 7.125C3 4.36358 5.23858 2.125 8 2.125C10.7614 2.125 13 4.36358 13 7.125C13 9.94141 13.6469 12.3383 14.25 13.375H1.75Z"
                    fill="#0D141C"
                  />
                </svg>
              </button>
             
            </div>
          </div>

          <!-- Right side - Logo -->
     
          <div class="logo-section">
             <img
              src="https://cdn.builder.io/api/v1/image/assets/TEMP/5029f4236f65d0d4d941d8086f6901a1afaa86c0"
              alt="Logo"
              class="logo-img"
            />
            <div class="logo-text font-cairo">صراحة</div>
           
          </div>
      
        </div>
      </header>
            <!-- Navigation Tabs -->
      <div class="nav-section">
        <div class="nav-container">
          <div class="nav-tabs-wrapper">
            <div class="nav-tabs">
              <a href="{{route('user.settings')}}" class="nav-tab {{ request()->routeIs('user.settings') ? 'active' : '' }} font-plus-jakarta">الإعدادات</a>
              <a href="{{route('user.statistics')}}" class="nav-tab {{ request()->routeIs('user.statistics') ? 'active' : '' }} font-plus-jakarta">الإحصائيات</a>
              <a href="{{route('user.profile')}}" class="nav-tab {{ request()->routeIs('user.profile') ? 'active' : '' }} font-plus-jakarta">الملف الشخصي</a>
              <a href="{{route('user.index')}}" class="nav-tab {{ request()->routeIs('user.index') ? 'active' : '' }} font-plus-jakarta">الرسائل</a>
              <a href="{{route('user')}}" class="nav-tab {{ request()->routeIs('user') ? 'active' : '' }} font-plus-jakarta"
                >الصفحة الرئيسية</a
              >
            </div>
          </div>
@yield('index-status')
        </div>
      </div>

        @yield('main')
        <footer class="footer">
        <span class="footer-text font-noto-serif"
          >جميع الحقوق محفوظة - صراحة © 2025</span
        >
      </footer>
</div>