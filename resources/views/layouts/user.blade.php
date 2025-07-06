<?php
use Illuminate\Support\Facades\Auth;
use App\Models\message;
use App\Models\Setting;
$settings = Setting::all()->keyBy('key');
$user = Auth::user();
$unreadMessages = $user
    ->messages()
    ->whereNull('read_at')
    ->latest()
    ->take(5)
    ->get();

$messagesPayload = $unreadMessages->map(function ($m) {
    return [
        'id'   => $m->id,
        'text' => 'رسالة جديدة من مجهول',
        'time' => $m->created_at->diffForHumans(),
    ];
})->values();
?>
<!doctype html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title> {{ !empty($settings['site_title']->value) ? $settings['site_title']->value: 'صراحة' }} - @yield('title')</title>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Noto+Serif:wght@400&display=swap" rel="stylesheet"/>
   <link rel="icon" href="{{url('images/logo.png')}}"/>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  @yield('page-css')
</head>

<body>
  <div class="container">
    <!-- Header -->
    <header class="header">
      <div class="header-content">
        <!-- يسار الهيدر -->
        <div class="header-left">
          <div class="header-actions">
            <div class="user-dropdown">
              @php
                $avatarPath = public_path('avatars/'.$user->avatar);
              @endphp
              @if($user->avatar && file_exists($avatarPath))
                <img src="{{ asset('avatars/'.$user->avatar) }}" 
                     alt="Profile"
                     class="profile-img"
                     id="userAvatar">
              @else
                <img src="{{ asset('images/profile.png') }}" 
                     alt="Profile"
                     class="profile-img"
                     id="userAvatar">
              @endif
              <div id="dropdownMenu" class="dropdown-menu">
                <p class="username">{{ $user->name }}</p>
                <form action="{{ route('logout') }}" method="post">
                  @csrf
                  <input type="submit" value="تسجيل الخروج" class="logout-btn">
                </form>
              </div>
            </div>

            <div class="notification-wrapper">
              <button id="notificationToggle"
                      class="notification-btn"
                      aria-label="Notifications"
                      data-url="{{ route('notifications.markRead') }}">
                @php
                  $unreadCount = Auth::user()->messages()->whereNull('read_at')->count();
                @endphp
                <span id="notifCount" class="notif-badge {{ $unreadCount ? '' : 'hidden' }}">
                  {{ $unreadCount }}
                </span>
                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="16" height="18" viewBox="0 0 16 18" fill="none">
                  <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M15.3281 12.7453C14.8945 11.9984 14.25 9.88516 14.25 7.125C14.25 3.67322 11.4518 0.875 8 0.875C4.54822 0.875 1.75 3.67322 1.75 7.125C1.75 9.88594 1.10469 11.9984 0.671094 12.7453C0.445722 13.1318 0.444082 13.6092 0.666796 13.9973C0.889509 14.3853 1.30261 14.6247 1.75 14.625H4.93828C5.23556 16.0796 6.51529 17.1243 8 17.1243C9.48471 17.1243 10.7644 16.0796 11.0617 14.625H14.25C14.6972 14.6244 15.1101 14.3849 15.3326 13.9969C15.5551 13.609 15.5534 13.1317 15.3281 12.7453ZM8 15.875C7.20562 15.8748 6.49761 15.3739 6.23281 14.625H9.76719C9.50239 15.3739 8.79438 15.8748 8 15.875ZM1.75 13.375C2.35156 12.3406 3 9.94375 3 7.125C3 4.36358 5.23858 2.125 8 2.125C10.7614 2.125 13 4.36358 13 7.125C13 9.94141 13.6469 12.3383 14.25 13.375H1.75Z"
                        fill="#0D141C"/>
                </svg>
              </button>

              <div class="notification-menu" id="notificationMenu">
                @forelse($unreadMessages as $message)
                  <div class="notif-item {{ $loop->first ? '' : 'with-line' }}">
                    <div class="notif-avatar">
                      <img src="{{ url('images/profile.png') }}" alt="User">
                    </div>
                    <div class="notif-content">
                      <p class="notif-text font-plus-jakarta">رسالة جديدة من مجهول</p>
                      <span class="notif-time font-plus-jakarta">
                        {{ $message->created_at->diffForHumans() }}
                      </span>
                    </div>
                  </div>
                @empty
                  <p class="no-notif">لا توجد رسائل جديدة</p>
                @endforelse
              </div>
            </div>
          </div>
        </div>
      <a href="/">
   <!-- يمين الهيدر -->
        <div class="logo-section">
          <img src="{{ !empty($settings['site_logo']->value) ? asset('uploads/' . $settings['site_logo']->value) : url('images/'.'logo.png') }}"
               alt="Logo" class="logo-img" />
          <div class="logo-text font-cairo">{{ !empty($settings['site_title']->value) ? $settings['site_title']->value: 'صراحة' }}</div>
        </div>
      </a>
     
      </div>
    </header>

    <!-- Navigation Tabs -->
    <div class="nav-section">
      <div class="nav-container">
        <div class="nav-tabs-wrapper">
          <div class="nav-tabs">
            <a href="{{ route('user.settings') }}" class="nav-tab {{ request()->routeIs('user.settings') ? 'active' : '' }} font-plus-jakarta">الإعدادات</a>
            <a href="{{ route('user.profile') }}" class="nav-tab {{ request()->routeIs('user.profile') ? 'active' : '' }} font-plus-jakarta">الملف الشخصي</a>
            <a href="{{ route('user.index') }}" class="nav-tab {{ request()->routeIs('user.index') ? 'active' : '' }} font-plus-jakarta">الرسائل</a>
            <a href="{{ route('user') }}" class="nav-tab {{ request()->routeIs('user') ? 'active' : '' }} font-plus-jakarta">الصفحة الرئيسية</a>
          </div>
        </div>
        @yield('index-status')
      </div>
    </div>

    @yield('main')

    <!-- Footer -->
    <footer class="footer">
      <span class="footer-text font-noto-serif">جميع الحقوق محفوظة ‑ صراحة © 2025</span>
    </footer>
  </div>

  <!-- ✅ JavaScript -->
  <script>
const MESSAGES = @json($messagesPayload);

document.addEventListener('DOMContentLoaded', () => {
  const badge     = document.getElementById('notifCount');
  const markUrl   = document.getElementById('notificationToggle')?.dataset.url;
  const menu      = document.getElementById('notificationMenu');
  const toggleBtn = document.getElementById('notificationToggle');

  let notifOpen = false, hoverTimer;

  if (toggleBtn && menu && badge) {
    buildNotifList();

    toggleBtn.addEventListener('click', e => {
      e.stopPropagation();
      notifOpen = !notifOpen;
      menu.style.display = notifOpen ? 'block' : 'none';
      if (notifOpen) markAsRead();
    });

    toggleBtn.addEventListener('mouseenter', () => {
      clearTimeout(hoverTimer);
      menu.style.display = 'block';
      notifOpen = true;
      markAsRead();
    });

    toggleBtn.addEventListener('mouseleave', () => {
      hoverTimer = setTimeout(() => {
        if (!menu.matches(':hover')) {
          menu.style.display = 'none';
          notifOpen = false;
        }
      }, 200);
    });

    menu.addEventListener('mouseleave', () => {
      menu.style.display = 'none';
      notifOpen = false;
    });
    menu.addEventListener('mouseenter', () => clearTimeout(hoverTimer));
    menu.addEventListener('click', e => e.stopPropagation());

    document.addEventListener('click', () => {
      if (notifOpen) {
        menu.style.display = 'none';
        notifOpen = false;
      }
    });
  }

  function markAsRead() {
    if (!badge || badge.classList.contains('hidden')) return;
    fetch(markUrl, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        'Accept'      : 'application/json',
      }
    })
    .then(res => res.ok ? res.json() : Promise.reject())
    .then(data => {
      badge.textContent = data.unreadCount;
      badge.classList.add('hidden');
    })
    .catch(() => console.error('لم يتمّ تحديث read_at (تحقّق من الـ Route و CSRF)'));
  }

  function buildNotifList() {
    if (!menu) return;
    if (!MESSAGES.length) {
      menu.innerHTML = '<p class="no-notif">لا توجد رسائل جديدة</p>';
      return;
    }
    menu.innerHTML = MESSAGES.map((m, i) => `
      <div class="notif-item ${i ? 'with-line' : ''}">
        <div class="notif-avatar">
          <img src="{{ url('images/profile.png') }}" alt="User">
        </div>
        <div class="notif-content">
          <p class="notif-text font-plus-jakarta">${m.text}</p>
          <span class="notif-time font-plus-jakarta">${m.time}</span>
        </div>
      </div>
    `).join('');
  }

  /* القائمة المنسدلة للمستخدم */
  const avatar   = document.getElementById('userAvatar');
  const dropdown = document.getElementById('dropdownMenu');
  let avatarOpen = false;
  let hoverTimeout;

  if (avatar && dropdown) {
    avatar.addEventListener('click', e => {
      e.stopPropagation();
      avatarOpen = !avatarOpen;
      dropdown.style.display = avatarOpen ? 'block' : 'none';
    });

    avatar.addEventListener('mouseenter', () => {
      clearTimeout(hoverTimeout);
      dropdown.style.display = 'block';
      avatarOpen = true;
    });

    avatar.addEventListener('mouseleave', () => {
      hoverTimeout = setTimeout(() => {
        if (!dropdown.matches(':hover')) {
          dropdown.style.display = 'none';
          avatarOpen = false;
        }
      }, 200);
    });

    dropdown.addEventListener('mouseenter', () => clearTimeout(hoverTimeout));
    dropdown.addEventListener('mouseleave', () => {
      dropdown.style.display = 'none';
      avatarOpen = false;
    });
    dropdown.addEventListener('click', e => e.stopPropagation());

    document.addEventListener('click', () => {
      if (avatarOpen) {
        dropdown.style.display = 'none';
        avatarOpen = false;
      }
    });
  }
});
  </script>
  @stack('scripts')
</body>
</html>
