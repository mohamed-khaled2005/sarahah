  @extends('layouts.admin')
  @section('title','لوحة التحكم')
  @section('page-css')
  <link rel="stylesheet" href="{{url('css/pages/admin/index.css')}}"/>
  @endsection

    
       @section('main')
      <!-- Main Content -->
      <div class="main-content">
        <!-- Page Title -->
        <h2 class="page-title">لوحة التحكم</h2>

        <!-- Stats Cards -->
        <div class="stats-grid">
  <div class="stats-card">
    <h3>إجمالي المستخدمين</h3>
    <div class="value">{{$users_number}}</div>
    <div class="change {{ strpos($monthlyChange, '-') === false ? 'positive' : 'negative' }}">
        {{$monthlyChange}}
    </div>
  </div>

  <div class="stats-card">
    <h3>الرسائل اليومية</h3>
    <div class="value">{{$daily_messages_number}}</div>
    <div class="change {{ strpos($dailyChange, '-') === false ? 'positive' : 'negative' }}">
        {{$dailyChange}}
    </div>
  </div>

  <div class="stats-card">
    <h3>الرسائل المبلغ عنها</h3>
    <div class="value">{{$reports_count}}</div>
    <div class="change positive">{{$reportsMonthlyChange}}</div>
  </div>

  <div class="stats-card">
    <h3>المستخدمين خلال شهر</h3>
    <div class="value">{{$currentMonthUsers}}</div>
    <div class="change positive">{{$monthlyChange}}</div>
  </div>
</div>

        <!-- Chart Section -->
        <div class="chart-section">
          <div class="chart-header">
            <div class="chart-title">
              الرسائل اليومية خلال الأيام السبعة الماضية
            </div>
            <div class="chart-value">{{$totalMessagesLastWeek}}</div>
            <div class="chart-subtitle">
              <span class="change">{{$weeklyChange}}</span>
              <span class="period">الأيام السبعة الماضية</span>
            </div>
          </div>
          <canvas id="messagesChart"></canvas>
        </div>

        <!-- Recent Events -->
        <h3 class="events-title">أحدث الأحداث</h3>

        {{-- events-timeline.blade.php --}}
<div class="events-list" id="eventsList">
    @foreach ($events as $index => $event)
        <div class="event-item {{ $index >= 4 ? 'hidden' : '' }}">
            <div class="event-icon-container">
                {{-- خط علوي صغير لكل العناصر ما عدا أوّل واحد --}}
                @if ($index > 0)
                    <div class="event-line short"></div>
                @endif

                {{-- أيقونة حسب نوع الحدث --}}
                @if ($event->type === 'تسجيل المستخدم الجديد')
                    <!-- أيقونة مستخدم -->
                    <svg class="event-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <line x1="19" y1="8" x2="24" y2="3"/>
                        <line x1="17" y1="6" x2="22" y2="1"/>
                    </svg>
                @else
                    <!-- أيقونة تقرير -->
                    <svg class="event-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/>
                        <line x1="4" y1="22" x2="4" y2="15"/>
                    </svg>
                @endif

                {{-- خط سفلي لكل العناصر ما عدا آخر واحد --}}
                @if (!$loop->last)
                    <div class="event-line"></div>
                @endif
            </div>

            <div class="event-content">
                <div class="event-title">{{ $event->type }}</div>
                <div class="event-time">{{ $event->created_at->diffForHumans() }}</div>
            </div>
        </div>
    @endforeach
</div>

@if ($events->count() > 4)
    <button id="loadMoreBtn" class="load-more">اعرض المزيد</button>
@endif


      </div>
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script>
    const labels = {!! json_encode(array_keys($dailyMessages->toArray())) !!};
    const data = {!! json_encode(array_values($dailyMessages->toArray())) !!};

    const ctx = document.getElementById('messagesChart').getContext('2d');
    const messagesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels, // التواريخ
            datasets: [{
                label: 'عدد الرسائل اليومية',
                data: data,
                borderColor: 'rgba(75, 192, 192, 1)',
                fill: false,
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            }
        }
    });

/*-------------events------------*/
document.addEventListener('DOMContentLoaded', () => {
    const itemsPerPage = 4;                       // عدد العناصر كل مرّة
    const items        = [...document.querySelectorAll('#eventsList .event-item')];
    let visibleCount   = itemsPerPage;            // المعروض حاليًا

    const btn = document.getElementById('loadMoreBtn');
    if (!btn) return;                             // لا يوجد زر = أقل من 4 عناصر أصلاً

    btn.addEventListener('click', () => {
        // أكشف العناصر التالية
        const next = items.slice(visibleCount, visibleCount + itemsPerPage);
        next.forEach(el => el.classList.remove('hidden'));
        visibleCount += itemsPerPage;

        // أخفي الزر إذا لم يتبقّ عناصر
        if (visibleCount >= items.length) {
            btn.style.display = 'none';
        }
    });
});

</script>
      @endsection


