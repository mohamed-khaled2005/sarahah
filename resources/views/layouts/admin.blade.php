<?php
use Illuminate\Support\Facades\Auth;
use App\Models\Event;

$user = Auth::user();

// آخر 5 أحداث غير مقروءة
$unreadEvents = Event::whereNull('read_at')->latest()->take(5)->get();
$unreadCount = Event::whereNull('read_at')->count();

$eventsPayload = $unreadEvents->map(function ($e) {
    return [
        'id'   => $e->id,
        'text' => $e->type,
        'time' => $e->created_at->diffForHumans(),
    ];
});
?>
<!doctype html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>@yield('title')</title>
<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{url('css/pages/admin/global.css')}}"/>
<style>
/* إشعارات */
.notification-bell {
    position: relative;
    margin-left: 15px;
    cursor: pointer;
}
.notif-badge {
    position: absolute;
    top: -5px;
    left: -5px;
    background: red;
    color: #fff;
    font-size: 11px;
    padding: 2px 6px;
    border-radius: 50%;
    font-weight: bold;
}
.hidden { display: none !important; }
.notif-menu {
    position: absolute;
    top: 120%;
    left: 0;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    min-width: 220px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    display: none;
    z-index: 1000;
}
.notif-item {
    padding: 10px;
    border-bottom: 1px solid #f0f0f0;
}
.notif-item:last-child { border-bottom: none; }
.notif-text { margin: 0; font-size: 14px; color: #333; }
.notif-time { font-size: 12px; color: #888; }
.no-notif {
    padding: 10px;
    text-align: center;
    color: #999;
    font-size: 13px;
}
/* القائمة المنسدلة للمستخدم */
.user-dropdown { position: relative; }
.dropdown-menu {
    position: absolute;
    top: 120%;
    right: 0;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    min-width: 150px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    display: none;
    z-index: 1000;
}
.username { margin: 10px; font-weight: bold; }
.logout-btn {
    width: 100%;
    border: none;
    background: #e74c3c;
    color: #fff;
    padding: 8px;
    cursor: pointer;
    border-radius: 0 0 8px 8px;
}
.user-avatar {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    cursor: pointer;
}
</style>
@yield('page-css')
</head>
<body>
<header class="header">
  <div class="header-container">
    <a href="/">
      <div class="logo-section">
        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/5029f4236f65d0d4d941d8086f6901a1afaa86c0?width=82" alt="صراحة" class="logo-img"/>
        <h1 class="logo-text">صراحة</h1>
      </div>
    </a>

    <div class="header-actions">
      
    
      <!-- 👤 المستخدم -->
      <div class="user-dropdown">
        <img id="userAvatar" src="{{url('images/profile.png')}}" alt="المستخدم" class="user-avatar"/>
        <div id="dropdownMenu" class="dropdown-menu">
          <p class="username">{{$user->name}}</p>
          <form action="{{route('logout')}}" method="post">@csrf
            <input type="submit" value="Logout" class="logout-btn">
          </form>
        </div>
      </div>
    <!-- 🔔 الجرس -->
      <div class="notification-bell" id="notifToggle" data-url="{{ route('admin.events.markRead') }}">
        <span id="notifCount" class="notif-badge {{ $unreadCount ? '' : 'hidden' }}">{{ $unreadCount }}</span>
        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"></path>
          <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"></path>
        </svg>
        <div id="notifMenu" class="notif-menu">
          @forelse($unreadEvents as $event)
            <div class="notif-item">
              <p class="notif-text">{{ $event->type }}</p>
              <span class="notif-time">{{ $event->created_at->diffForHumans() }}</span>
            </div>
          @empty
            <p class="no-notif">لا توجد إشعارات جديدة</p>
          @endforelse
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
           
            <a href="{{route('admin.ads.index')}}">
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


            <a href="{{route('pages.index')}}">
          <div class="nav-item {{ request()->routeIs('pages.index') ? 'active' : '' }}">
            <svg class="nav-icon" fill="#000000" viewBox="0 0 30.00 30.00" xmlns="http://www.w3.org/2000/svg" stroke="#000000" stroke-width="1.2"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.18"></g><g id="SVGRepo_iconCarrier"><path d="M19.5 2c-.276.004-.504.224-.5.5v4c0 .815.656 1.5 1.47 1.5h4.03c.67 0 .654-1 0-1h-4.03c-.26 0-.47-.207-.47-.5v-4c.004-.282-.218-.504-.5-.5zM8.47 0C7.657 0 7 .685 7 1.5v23c0 .815.656 1.5 1.47 1.5h17.06c.814 0 1.47-.685 1.47-1.5v-18c0-.133-.053-.26-.146-.354l-6-6C20.76.053 20.634 0 20.5 0zm0 1h11.823L26 6.707V24.5c0 .293-.21.5-.47.5H8.47c-.26 0-.47-.207-.47-.5v-23c0-.293.21-.5.47-.5zm-4 3C3.657 4 3 4.685 3 5.5v23c0 .815.656 1.5 1.47 1.5h17.06c.814 0 1.47-.685 1.47-1.5v-1c.01-.676-1.01-.676-1 0v1c0 .293-.21.5-.47.5H4.47c-.26 0-.47-.207-.47-.5v-23c0-.293.21-.5.47-.5h1.06c.675.01.675-1.01 0-1z"></path></g></svg>
              <span>الصفحات</span>
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
       
        
<script>
document.addEventListener('DOMContentLoaded', () => {
  const notifBtn = document.getElementById('notifToggle');
  const notifMenu = document.getElementById('notifMenu');
  const badge = document.getElementById('notifCount');
  const markUrl = notifBtn.dataset.url;
  let open = false, hoverTimer;

  notifBtn.addEventListener('click', e => {
    e.stopPropagation();
    open = !open;
    notifMenu.style.display = open ? 'block' : 'none';
    if(open) markAsRead();
  });

  notifBtn.addEventListener('mouseenter', () => {
    clearTimeout(hoverTimer);
    notifMenu.style.display = 'block';
    open = true;
    markAsRead();
  });

  notifBtn.addEventListener('mouseleave', () => {
    hoverTimer = setTimeout(() => {
      if(!notifMenu.matches(':hover')) {
        notifMenu.style.display = 'none';
        open=false;
      }
    },200);
  });
  notifMenu.addEventListener('mouseenter', ()=>clearTimeout(hoverTimer));
  notifMenu.addEventListener('mouseleave', ()=>{notifMenu.style.display='none';open=false;});
  notifMenu.addEventListener('click', e=>e.stopPropagation());
  document.addEventListener('click', ()=>{if(open){notifMenu.style.display='none';open=false;}});

  function markAsRead(){
    if(badge.classList.contains('hidden')) return;
    fetch(markUrl, {
      method:'POST',
      headers:{'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content}
    })
    .then(res=>res.ok?res.json():Promise.reject())
    .then(data=>{
      badge.textContent = data.unreadCount;
      badge.classList.add('hidden');
    })
    .catch(()=>console.error('فشل تحديث read_at'));
  }
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const avatar = document.getElementById('userAvatar');
  const menu = document.getElementById('dropdownMenu');
  let isOpen = false;
  avatar.addEventListener('click', e => { e.stopPropagation(); isOpen=!isOpen; menu.style.display=isOpen?'block':'none'; });
  avatar.addEventListener('mouseenter', ()=>{ menu.style.display='block'; isOpen=true; });
  avatar.addEventListener('mouseleave', ()=>{ setTimeout(()=>{ if(!menu.matches(':hover')){menu.style.display='none'; isOpen=false;}},100); });
  menu.addEventListener('mouseleave', ()=>{ menu.style.display='none'; isOpen=false; });
  menu.addEventListener('click', e=>e.stopPropagation());
  document.addEventListener('click', ()=>{ if(isOpen){menu.style.display='none'; isOpen=false;} });
});
</script>
</body>
</html>