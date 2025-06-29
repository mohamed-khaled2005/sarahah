<!doctype html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>صراحة - إدارة المستخدمين</title>
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
        max-width: 960px;
      }

      .page-header {
        padding: 16px;
        margin-bottom: 12px;
      }

      .page-title {
        font-size: 32px;
        font-weight: 700;
        color: #121217;
        text-align: right;
      }

      /* Search Section */
      .search-section {
        padding: 12px 16px;
        margin-bottom: 16px;
      }

      .search-container {
        display: flex;
        align-items: stretch;
        background-color: #ebedf2;
        border-radius: 12px;
        height: 48px;
      }

      .search-icon-container {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 16px;
        background-color: #ebedf2;
        border-radius: 12px 0 0 12px;
      }

      .search-icon {
        width: 20px;
        height: 20px;
        color: #5c698a;
      }

      .search-input {
        flex: 1;
        padding: 8px 16px 8px 8px;
        background-color: #ebedf2;
        border: none;
        border-radius: 0 12px 12px 0;
        color: #5c698a;
        font-size: 16px;
        outline: none;
      }

      .search-input::placeholder {
        color: #5c698a;
      }

      /* Filter Section */
      .filter-header {
        padding: 16px 16px 8px 16px;
        text-align: center;
      }

      .filter-title {
        font-size: 18px;
        font-weight: 700;
        color: #121217;
      }

      .filter-section {
        padding: 12px 16px;
        margin-bottom: 12px;
      }

      .filter-dropdown {
        max-width: 480px;
        margin: 0 auto;
      }

      .dropdown-container {
        position: relative;
        height: 56px;
        border-radius: 12px;
        border: 1px solid #d6d9e3;
        background-color: #fafafa;
        display: flex;
        align-items: center;
        padding: 0 16px;
        cursor: pointer;
      }

      .dropdown-text {
        color: #121217;
        font-size: 16px;
        flex: 1;
      }

      .dropdown-arrow {
        width: 20px;
        height: 20px;
        color: #5c698a;
      }

      /* Table Section */
      .table-section {
        padding: 12px 16px;
        margin-bottom: 16px;
      }

      .table-container {
        background-color: #fafafa;
        border: 1px solid #d6d9e3;
        border-radius: 12px;
        overflow: hidden;
      }

      .table {
        width: 100%;
        border-collapse: collapse;
      }

      .table-header {
        background-color: #fafafa;
      }

      .table-header th {
        padding: 12px 16px;
        text-align: center;
        color: #121217;
        font-size: 14px;
        font-weight: 500;
        border-bottom: 1px solid #e5e8eb;
      }

      .table-header th:first-child {
        text-align: right;
      }

      .table-row {
        border-top: 1px solid #e5e8eb;
      }

      .table-row:hover {
        background-color: #f8f9fa;
      }

      .table-cell {
        padding: 8px 16px;
        text-align: center;
        font-size: 14px;
        color: #121217;
        height: 72px;
        vertical-align: middle;
      }

      .table-cell:first-child {
        text-align: right;
        color: #121217;
        font-weight: 400;
      }

      .table-cell.email {
        color: #5c698a;
      }

      .table-cell.date {
        color: #5c698a;
      }

      .table-cell.actions {
        color: #5c698a;
        font-weight: 700;
      }

      .status-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: #ebedf2;
        border-radius: 16px;
        padding: 0 16px;
        height: 32px;
        font-size: 14px;
        font-weight: 500;
        color: #121217;
        min-width: 84px;
      }

      /* Pagination */
      .pagination-section {
        padding: 16px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
      }

      .pagination-button {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 20px;
        border: none;
        background: none;
        cursor: pointer;
        color: #121217;
        font-size: 14px;
        transition: background-color 0.15s;
      }

      .pagination-button:hover {
        background-color: #ebedf2;
      }

      .pagination-button.active {
        background-color: #ebedf2;
        font-weight: 700;
      }

      .pagination-arrow {
        width: 18px;
        height: 18px;
        color: #121217;
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

        .main-content {
          max-width: none;
        }
      }

      @media (max-width: 768px) {
        .header-container {
          padding: 12px 16px;
        }

        .table-container {
          overflow-x: auto;
        }

        .table {
          min-width: 600px;
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
            <div class="nav-item">
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

            <div class="nav-item active">
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
        <!-- Page Header -->
        <div class="page-header">
          <h2 class="page-title">إدارة المستخدمين</h2>
        </div>

        <!-- Search Section -->
        <div class="search-section">
          <div class="search-container">
            <div class="search-icon-container">
              <svg
                class="search-icon"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
              >
                <circle cx="11" cy="11" r="8" />
                <path d="M21 21l-4.35-4.35" />
              </svg>
            </div>
            <input
              type="text"
              class="search-input"
              placeholder="ابحث  عن المستخدمين"
            />
          </div>
        </div>

        <!-- Filter Header -->
        <div class="filter-header">
          <h3 class="filter-title">تصفية المستخدمين</h3>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
          <div class="filter-dropdown">
            <div class="dropdown-container">
              <span class="dropdown-text">اختر الحالة</span>
              <svg
                class="dropdown-arrow"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
              >
                <polyline points="6,9 12,15 18,9" />
              </svg>
            </div>
          </div>
        </div>

        <!-- Table Section -->
        <div class="table-section">
          <div class="table-container">
            <table class="table">
              <thead class="table-header">
                <tr>
                  <th>اسم المستخدم</th>
                  <th>البريد الإلكتروني</th>
                  <th>تاريخ التس��يل</th>
                  <th>الحالة</th>
                  <th>الإجراءات</th>
                </tr>
              </thead>
              <tbody>
                <tr class="table-row">
                  <td class="table-cell">محمد العلي</td>
                  <td class="table-cell email">m.ali@email.com</td>
                  <td class="table-cell date">2023-01-15</td>
                  <td class="table-cell">
                    <span class="status-badge">نشط</span>
                  </td>
                  <td class="table-cell actions">تعليق, حذف, عرض</td>
                </tr>
                <tr class="table-row">
                  <td class="table-cell">ليلى السليمان</td>
                  <td class="table-cell email">l.sulaiman@email.com</td>
                  <td class="table-cell date">2023-02-20</td>
                  <td class="table-cell">
                    <span class="status-badge">نشط</span>
                  </td>
                  <td class="table-cell actions">تعليق, حذف, عرض</td>
                </tr>
                <tr class="table-row">
                  <td class="table-cell">عبد الله الرحمن</td>
                  <td class="table-cell email">a.rahman@email.com</td>
                  <td class="table-cell date">2023-03-10</td>
                  <td class="table-cell">
                    <span class="status-badge">نشط</span>
                  </td>
                  <td class="table-cell actions">تعليق, حذف, عرض</td>
                </tr>
                <tr class="table-row">
                  <td class="table-cell">سارة المالكي</td>
                  <td class="table-cell email">s.maliki@email.com</td>
                  <td class="table-cell date">2023-04-05</td>
                  <td class="table-cell">
                    <span class="status-badge">نشط</span>
                  </td>
                  <td class="table-cell actions">تعليق, حذف, عرض</td>
                </tr>
                <tr class="table-row">
                  <td class="table-cell">نور الهدى</td>
                  <td class="table-cell email">n.huda@email.com</td>
                  <td class="table-cell date">2023-05-12</td>
                  <td class="table-cell">
                    <span class="status-badge">نشط</span>
                  </td>
                  <td class="table-cell actions">تعليق, حذف, عرض</td>
                </tr>
                <tr class="table-row">
                  <td class="table-cell">يوس�� الحسين</td>
                  <td class="table-cell email">y.hussein@email.com</td>
                  <td class="table-cell date">2023-06-18</td>
                  <td class="table-cell">
                    <span class="status-badge">نشط</span>
                  </td>
                  <td class="table-cell actions">تعليق, حذف, عرض</td>
                </tr>
                <tr class="table-row">
                  <td class="table-cell">ريم العامري</td>
                  <td class="table-cell email">r.amri@email.com</td>
                  <td class="table-cell date">2023-07-22</td>
                  <td class="table-cell">
                    <span class="status-badge">نشط</span>
                  </td>
                  <td class="table-cell actions">تعليق, حذف, عرض</td>
                </tr>
                <tr class="table-row">
                  <td class="table-cell">علي السيد</td>
                  <td class="table-cell email">a.saeed@email.com</td>
                  <td class="table-cell date">2023-08-01</td>
                  <td class="table-cell">
                    <span class="status-badge">نشط</span>
                  </td>
                  <td class="table-cell actions">تعليق, حذف, عرض</td>
                </tr>
                <tr class="table-row">
                  <td class="table-cell">ميرا الفهد</td>
                  <td class="table-cell email">m.fahad@email.com</td>
                  <td class="table-cell date">2023-09-15</td>
                  <td class="table-cell">
                    <span class="status-badge">نشط</span>
                  </td>
                  <td class="table-cell actions">تعليق, حذف, عرض</td>
                </tr>
                <tr class="table-row">
                  <td class="table-cell">خالد العثمان</td>
                  <td class="table-cell email">k.othman@email.com</td>
                  <td class="table-cell date">2023-10-20</td>
                  <td class="table-cell">
                    <span class="status-badge">نشط</span>
                  </td>
                  <td class="table-cell actions">تعليق, حذف, عرض</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Pagination -->
        <div class="pagination-section">
          <button class="pagination-button">
            <svg
              class="pagination-arrow"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
            >
              <polyline points="15,18 9,12 15,6" />
            </svg>
          </button>
          <button class="pagination-button active">1</button>
          <button class="pagination-button">2</button>
          <button class="pagination-button">3</button>
          <button class="pagination-button">4</button>
          <button class="pagination-button">5</button>
          <button class="pagination-button">
            <svg
              class="pagination-arrow"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
            >
              <polyline points="9,18 15,12 9,6" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </body>
</html>
