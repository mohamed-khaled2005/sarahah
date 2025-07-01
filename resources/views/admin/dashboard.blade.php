  
  @extends('layouts.admin')
  @section('title','صراحة - لوحة التحكم')
  @section('page-css')
  <link rel="stylesheet" href="{{url('css/pages/admin/index.css')}}"/>
  @endsection

    
       @section('main')
      <!-- Main Content -->
      <div class="main-content">
        <?php
      
        
        ?>
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
    <div class="value">0</div>
    <div class="change positive">+10%</div>
  </div>

  <div class="stats-card">
    <h3>الزوار اليومية</h3>
    <div class="value">0</div>
    <div class="change positive">+8%</div>
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

          <!-- <div class="chart-container">
            <svg
              width="100%"
              height="148"
              viewBox="0 0 826 148"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <defs>
                <linearGradient
                  id="chartGradient"
                  x1="0"
                  y1="0"
                  x2="0"
                  y2="148"
                  gradientUnits="userSpaceOnUse"
                >
                  <stop stop-color="#EBEDF2" />
                  <stop offset="0.5" stop-color="#EBEDF2" stop-opacity="0" />
                </linearGradient>
              </defs>
              <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M5.1841 188.356C36.5545 188.356 36.5545 36.2887 67.925 36.2887C99.2954 36.2887 99.2954 70.8494 130.666 70.8494C162.036 70.8494 162.036 160.707 193.407 160.707C224.777 160.707 224.777 57.0251 256.148 57.0251C287.519 57.0251 287.519 174.531 318.888 174.531C350.259 174.531 350.259 105.41 381.629 105.41C413 105.41 413 77.7615 444.371 77.7615C475.741 77.7615 475.741 209.092 507.112 209.092C538.481 209.092 538.481 257.477 569.852 257.477C601.223 257.477 601.223 1.72803 632.593 1.72803C663.964 1.72803 663.964 139.971 695.335 139.971C726.704 139.971 726.704 222.916 758.074 222.916C789.445 222.916 789.445 43.2008 820.816 43.2008V257.477H569.852H5.1841V188.356Z"
                fill="url(#chartGradient)"
              />
              <path
                d="M5.1841 188.356C36.5545 188.356 36.5545 36.2887 67.925 36.2887C99.2954 36.2887 99.2954 70.8494 130.666 70.8494C162.036 70.8494 162.036 160.707 193.407 160.707C224.777 160.707 224.777 57.0251 256.148 57.0251C287.519 57.0251 287.519 174.531 318.888 174.531C350.259 174.531 350.259 105.41 381.629 105.41C413 105.41 413 77.7615 444.371 77.7615C475.741 77.7615 475.741 209.092 507.112 209.092C538.481 209.092 538.481 257.477 569.852 257.477C601.223 257.477 601.223 1.72803 632.593 1.72803C663.964 1.72803 663.964 139.971 695.335 139.971C726.704 139.971 726.704 222.916 758.074 222.916C789.445 222.916 789.445 43.2008 820.816 43.2008"
                stroke="#5C698A"
                stroke-width="3"
              />
            </svg>
          </div> -->

          <!-- <div class="chart-days">
            <span>السبت</span>
            <span>الجمعة</span>
            <span>الخميس</span>
            <span>الأربعاء</span>
            <span>الثلاثاء</span>
            <span>الاثنين</span>
            <span>الأحد</span>
          </div> -->
          <canvas id="messagesChart"></canvas>
        </div>

        <!-- Recent Events -->
        <h3 class="events-title">أحدث الأحداث</h3>

        <div class="events-list">
          <div class="event-item">
            <div class="event-icon-container">
              <svg
                class="event-icon"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
              >
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <line x1="19" y1="8" x2="24" y2="3" />
                <line x1="17" y1="6" x2="22" y2="1" />
              </svg>
              <div class="event-line"></div>
            </div>
            <div class="event-content">
              <div class="event-title">تسجيل المستخدم الجديد</div>
              <div class="event-time">منذ 5 دقائق</div>
            </div>
          </div>

          <div class="event-item">
            <div class="event-icon-container">
              <div class="event-line short"></div>
              <svg
                class="event-icon"
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
              <div class="event-line"></div>
            </div>
            <div class="event-content">
              <div class="event-title">تقرير جديد</div>
              <div class="event-time">منذ 10 دقائق</div>
            </div>
          </div>

          <div class="event-item">
            <div class="event-icon-container">
              <div class="event-line short"></div>
              <svg
                class="event-icon"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
              >
                <path
                  d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"
                />
                <path
                  d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"
                />
              </svg>
              <div class="event-line"></div>
            </div>
            <div class="event-content">
              <div class="event-title">تعديل الرسالة</div>
              <div class="event-time">منذ 15 دقائق</div>
            </div>
          </div>

          <div class="event-item">
            <div class="event-icon-container">
              <div class="event-line short"></div>
              <svg
                class="event-icon"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
              >
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <line x1="19" y1="8" x2="24" y2="3" />
                <line x1="17" y1="6" x2="22" y2="1" />
              </svg>
              <div class="event-line"></div>
            </div>
            <div class="event-content">
              <div class="event-title">تسجيل المستخدم الجديد</div>
              <div class="event-time">منذ 20 دقائق</div>
            </div>
          </div>

          <div class="event-item">
            <div class="event-icon-container">
              <div class="event-line short"></div>
              <svg
                class="event-icon"
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
            </div>
            <div class="event-content">
              <div class="event-title">تقرير جديد</div>
              <div class="event-time">منذ 25 دقائق</div>
            </div>
          </div>
        </div>
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
</script>
      @endsection


