<!doctype html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>صراحة - لوحة التحكم</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        font-family:
          "Plus Jakarta Sans",
          -apple-system,
          Roboto,
          Helvetica,
          sans-serif;
        background-color: #fafafa;
        direction: rtl;
        min-height: 100vh;
      }

      .font-cairo {
        font-family:
          "Cairo",
          -apple-system,
          Roboto,
          Helvetica,
          sans-serif;
      }

      /* Header */
      .header {
        background-color: #f7fafa;
        border-bottom: 1px solid #e5e8eb;
      }

      .header-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 44px;
        max-width: 1280px;
        margin: 0 auto;
      }

      .logo-section {
        display: flex;
        align-items: center;
        gap: 8px;
      }

      .logo-img {
        width: 40px;
        height: 40px;
      }

      .logo-text {
        font-family:
          "Cairo",
          -apple-system,
          Roboto,
          Helvetica,
          sans-serif;
        font-size: 23px;
        font-weight: 700;
        color: #0d121c;
      }

      .header-actions {
        display: flex;
        align-items: center;
        gap: 36px;
      }

      .notification-bell {
        display: flex;
        align-items: center;
        gap: 8px;
        background-color: #e8edf2;
        border-radius: 12px;
        padding: 8px 12px;
      }

      .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
      }

      /* Main Layout */
      .main-container {
        display: flex;
        max-width: 1280px;
        margin: 0 auto;
      }

      /* Sidebar */
      .sidebar {
        width: 320px;
        background-color: #fafafa;
        padding: 16px;
        min-height: 100vh;
      }

      .sidebar-content {
        background-color: #fafafa;
        padding: 16px;
        border-radius: 8px;
        min-height: 700px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
      }

      .nav-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px;
        border-radius: 20px;
        margin-bottom: 8px;
        transition: background-color 0.15s;
        cursor: pointer;
      }

      .nav-item.active {
        background-color: #ebedf2;
      }

      .nav-item:hover {
        background-color: #ebedf2;
      }

      .nav-item span {
        color: #121217;
        font-weight: 500;
        font-size: 14px;
      }

      .nav-icon {
        width: 24px;
        height: 24px;
        color: #121217;
      }

      /* Main Content */
      .main-content {
        flex: 1;
        padding: 16px;
      }

      .page-title {
        font-size: 32px;
        font-weight: 700;
        color: #121217;
        text-align: right;
        margin-bottom: 32px;
      }

      /* Stats Grid */
      .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin-bottom: 32px;
      }

      .stats-card {
        background-color: white;
        border: 1px solid #d6d9e3;
        border-radius: 12px;
        padding: 24px;
        text-align: right;
      }

      .stats-card h3 {
        color: #121217;
        font-weight: 500;
        font-size: 16px;
        margin-bottom: 8px;
      }

      .stats-card .value {
        color: #121217;
        font-weight: 700;
        font-size: 24px;
        margin-bottom: 8px;
      }

      .stats-card .change {
        font-weight: 500;
        font-size: 16px;
      }

      .change.positive {
        color: #08873d;
      }

      .change.negative {
        color: #e83d08;
      }

      /* Chart Section */
      .chart-section {
        background-color: white;
        border: 1px solid #d6d9e3;
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 32px;
      }

      .chart-header {
        text-align: right;
        margin-bottom: 16px;
      }

      .chart-title {
        color: #121217;
        font-weight: 500;
        font-size: 16px;
        margin-bottom: 8px;
      }

      .chart-value {
        color: #121217;
        font-weight: 700;
        font-size: 32px;
      }

      .chart-subtitle {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 4px;
        font-size: 14px;
      }

      .chart-subtitle .change {
        color: #08873d;
        font-weight: 500;
      }

      .chart-subtitle .period {
        color: #5c698a;
      }

      .chart-container {
        margin: 24px 0;
      }

      .chart-days {
        display: flex;
        justify-content: space-between;
        font-size: 13px;
        font-weight: 700;
        color: #5c698a;
      }

      /* Recent Events */
      .events-title {
        font-size: 22px;
        font-weight: 700;
        color: #121217;
        text-align: right;
        margin-bottom: 16px;
      }

      .events-list {
        margin-bottom: 24px;
      }

      .event-item {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        margin-bottom: 16px;
      }

      .event-icon-container {
        display: flex;
        flex-direction: column;
        align-items: center;
      }

      .event-icon {
        width: 24px;
        height: 24px;
        color: #121217;
        margin-top: 12px;
      }

      .event-line {
        width: 2px;
        height: 32px;
        background-color: #d6d9e3;
        margin-top: 4px;
      }

      .event-line.short {
        height: 8px;
      }

      .event-content {
        flex: 1;
        padding: 12px 0;
      }

      .event-title {
        color: #121217;
        font-weight: 500;
        font-size: 16px;
        text-align: right;
        margin-bottom: 4px;
      }

      .event-time {
        color: #5c698a;
        font-size: 16px;
        text-align: right;
      }

      /* Responsive Design */
      @media (max-width: 1024px) {
        .main-container {
          flex-direction: column;
        }

        .sidebar {
          width: 100%;
          min-height: auto;
        }

        .stats-grid {
          grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        }
      }

      @media (max-width: 768px) {
        .header-container {
          padding: 12px 16px;
        }

        .stats-grid {
          grid-template-columns: 1fr;
        }

        .main-content {
          padding: 8px;
        }
      }
    </style>
  </head>
  <body>
    <!-- Header -->
    <header class="header">
      <div class="header-container">
        <!-- Logo -->
        <div class="logo-section">
          <img
            src="https://cdn.builder.io/api/v1/image/assets/TEMP/5029f4236f65d0d4d941d8086f6901a1afaa86c0?width=82"
            alt="صراحة"
            class="logo-img"
          />
          <h1 class="logo-text">صراحة</h1>
        </div>

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
          <img
            src="https://cdn.builder.io/api/v1/image/assets/TEMP/015fa293e459dfe000ffdda9c07ca06898cad73e?width=80"
            alt="المستخدم"
            class="user-avatar"
          />
        </div>
      </div>
    </header>

    <div class="main-container">
      <!-- Sidebar -->
      <div class="sidebar">
        <div class="sidebar-content">
          <nav>
            <div class="nav-item active">
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
            </div>

            <div class="nav-item">
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

            <div class="nav-item">
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

            <div class="nav-item">
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

            <div class="nav-item">
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

            <div class="nav-item">
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

            <div class="nav-item">
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
            </div>
          </nav>
        </div>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <!-- Page Title -->
        <h2 class="page-title">لوحة التحكم</h2>

        <!-- Stats Cards -->
        <div class="stats-grid">
          <div class="stats-card">
            <h3>إجمالي المستخدمين</h3>
            <div class="value">12,345</div>
            <div class="change positive">+5%</div>
          </div>

          <div class="stats-card">
            <h3>الرسائل اليومية</h3>
            <div class="value">678</div>
            <div class="change negative">-2%</div>
          </div>

          <div class="stats-card">
            <h3>الرسائل المبلغ عنها</h3>
            <div class="value">90</div>
            <div class="change positive">+10%</div>
          </div>

          <div class="stats-card">
            <h3>الزوار اليومية</h3>
            <div class="value">1,234</div>
            <div class="change positive">+8%</div>
          </div>
        </div>

        <!-- Chart Section -->
        <div class="chart-section">
          <div class="chart-header">
            <div class="chart-title">
              الرسائل اليومية خلال الأيام السبعة الماضية
            </div>
            <div class="chart-value">500</div>
            <div class="chart-subtitle">
              <span class="change">+10%</span>
              <span class="period">الأيام السبعة الماضية</span>
            </div>
          </div>

          <div class="chart-container">
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
          </div>

          <div class="chart-days">
            <span>السبت</span>
            <span>الجمعة</span>
            <span>الخميس</span>
            <span>الأربعاء</span>
            <span>الثلاثاء</span>
            <span>الاثنين</span>
            <span>الأحد</span>
          </div>
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
    </div>
  </body>
</html>
