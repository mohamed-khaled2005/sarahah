<!doctype html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>صراحة - التقارير</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700&family=Public+Sans:wght@400;500;600;700&display=swap"
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
          "Public Sans",
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
        color: #121417;
        text-align: right;
        font-family:
          "Public Sans",
          -apple-system,
          Roboto,
          Helvetica,
          sans-serif;
      }

      /* Toolbar */
      .toolbar {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 12px 16px;
        margin-bottom: 12px;
      }

      .toolbar-icons {
        display: flex;
        align-items: flex-start;
        gap: 8px;
      }

      .toolbar-icon {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 8px;
        cursor: pointer;
      }

      .toolbar-icon svg {
        width: 24px;
        height: 24px;
        color: #121417;
      }

      .delete-button {
        display: flex;
        height: 40px;
        max-width: 480px;
        padding: 0 16px;
        justify-content: center;
        align-items: center;
        gap: 8px;
        border-radius: 8px;
        background-color: #3d99f5;
        border: none;
        cursor: pointer;
        transition: opacity 0.15s;
      }

      .delete-button:hover {
        opacity: 0.9;
      }

      .delete-button svg {
        width: 20px;
        height: 20px;
        color: white;
      }

      .delete-button span {
        color: white;
        font-family:
          "Public Sans",
          -apple-system,
          Roboto,
          Helvetica,
          sans-serif;
        font-size: 14px;
        font-weight: 700;
        line-height: 21px;
        white-space: nowrap;
      }

      /* Table Section */
      .table-section {
        padding: 12px 16px;
        margin-bottom: 16px;
      }

      .table-container {
        background-color: white;
        border: 1px solid #dbe0e5;
        border-radius: 8px;
        overflow: hidden;
      }

      .table {
        width: 100%;
        border-collapse: collapse;
      }

      .table-header {
        background-color: white;
      }

      .table-header th {
        padding: 12px 16px;
        text-align: center;
        color: #121417;
        font-size: 14px;
        font-weight: 500;
        border-bottom: 1px solid #e5e8eb;
        font-family:
          "Public Sans",
          -apple-system,
          Roboto,
          Helvetica,
          sans-serif;
      }

      .table-header th:first-child {
        width: 73px;
      }

      .table-header th:nth-child(2) {
        text-align: right;
        width: 177px;
      }

      .table-header th:nth-child(6) {
        color: #61758a;
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
        color: #61758a;
        height: 72px;
        vertical-align: middle;
        font-family:
          "Public Sans",
          -apple-system,
          Roboto,
          Helvetica,
          sans-serif;
      }

      .table-cell:first-child {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 72px;
      }

      .table-cell:nth-child(2) {
        text-align: right;
      }

      .table-cell.actions {
        font-weight: 700;
      }

      .checkbox {
        width: 20px;
        height: 20px;
        border-radius: 4px;
        border: 2px solid #dbe0e5;
        background-color: white;
        cursor: pointer;
      }

      .checkbox:checked {
        background-color: #3d99f5;
        border-color: #3d99f5;
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
          min-width: 800px;
        }

        .main-content {
          padding: 8px;
        }

        .toolbar {
          flex-direction: column;
          gap: 12px;
          align-items: stretch;
        }

        .toolbar-icons {
          justify-content: center;
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
              <span>الرئيسية</span>
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

            <div class="nav-item active">
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
          <h2 class="page-title">الرسائل المبلغ عنها</h2>
        </div>

        <!-- Toolbar -->
        <div class="toolbar">
          <div class="toolbar-icons">
            <div class="toolbar-icon">
              <svg viewBox="0 0 24 24" fill="currentColor">
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M16.5 2H14.25V1.25C14.25 0.835786 13.9142 0.5 13.5 0.5C13.0858 0.5 12.75 0.835786 12.75 1.25V2H5.25V1.25C5.25 0.835786 4.91421 0.5 4.5 0.5C4.08579 0.5 3.75 0.835786 3.75 1.25V2H1.5C0.671573 2 0 2.67157 0 3.5V18.5C0 19.3284 0.671573 20 1.5 20H16.5C17.3284 20 18 19.3284 18 18.5V3.5C18 2.67157 17.3284 2 16.5 2Z"
                />
              </svg>
            </div>
            <div class="toolbar-icon">
              <svg viewBox="0 0 24 24" fill="currentColor">
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M19.5306 18.4694L14.8366 13.7762C17.6629 10.383 17.3204 5.36693 14.0591 2.38935C10.7978 -0.588237 5.77134 -0.474001 2.64867 2.64867C-0.474001 5.77134 -0.588237 10.7978 2.38935 14.0591C5.36693 17.3204 10.383 17.6629 13.7762 14.8366L18.4694 19.5306C18.7624 19.8237 19.2376 19.8237 19.5306 19.5306C19.8237 19.2376 19.8237 18.7624 19.5306 18.4694Z"
                />
              </svg>
            </div>
            <div class="toolbar-icon">
              <svg viewBox="0 0 24 24" fill="currentColor">
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M9 7C9 7.41421 8.66421 7.75 8.25 7.75H1.5C1.08579 7.75 0.75 7.41421 0.75 7C0.75 6.58579 1.08579 6.25 1.5 6.25H8.25C8.66421 6.25 9 6.58579 9 7ZM1.5 1.75H14.25C14.6642 1.75 15 1.41421 15 1C15 0.585786 14.6642 0.25 14.25 0.25H1.5C1.08579 0.25 0.75 0.585786 0.75 1C0.75 1.41421 1.08579 1.75 1.5 1.75ZM6.75 12.25H1.5C1.08579 12.25 0.75 12.5858 0.75 13C0.75 13.4142 1.08579 13.75 1.5 13.75H6.75C7.16421 13.75 7.5 13.4142 7.5 13C7.5 12.5858 7.16421 12.25 6.75 12.25ZM18.5306 10.2194C18.3899 10.0785 18.1991 9.99941 18 9.99941C17.8009 9.99941 17.6101 10.0785 17.4694 10.2194L15 12.6897V5.5C15 5.08579 14.6642 4.75 14.25 4.75C13.8358 4.75 13.5 5.08579 13.5 5.5V12.6897L11.0306 10.2194C10.7376 9.92632 10.2624 9.92632 9.96937 10.2194C9.67632 10.5124 9.67632 10.9876 9.96937 11.2806L13.7194 15.0306C13.8601 15.1715 14.0509 15.2506 14.25 15.2506C14.4491 15.2506 14.6399 15.1715 14.7806 15.0306L18.5306 11.2806C18.6715 11.1399 18.7506 10.9491 18.7506 10.75C18.7506 10.5509 18.6715 10.3601 18.5306 10.2194Z"
                />
              </svg>
            </div>
          </div>

          <button class="delete-button">
            <svg viewBox="0 0 24 24" fill="currentColor">
              <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M14.875 2.75H11.75V2.125C11.75 1.08947 10.9105 0.25 9.875 0.25H6.125C5.08947 0.25 4.25 1.08947 4.25 2.125V2.75H1.125C0.779822 2.75 0.5 3.02982 0.5 3.375C0.5 3.72018 0.779822 4 1.125 4H1.75V15.25C1.75 15.9404 2.30964 16.5 3 16.5H13C13.6904 16.5 14.25 15.9404 14.25 15.25V4H14.875C15.2202 4 15.5 3.72018 15.5 3.375C15.5 3.02982 15.2202 2.75 14.875 2.75Z"
              />
            </svg>
            <span>حذف المحدد</span>
          </button>
        </div>

        <!-- Table Section -->
        <div class="table-section">
          <div class="table-container">
            <table class="table">
              <thead class="table-header">
                <tr>
                  <th></th>
                  <th>محتوى الرسالة</th>
                  <th>تاريخ الإرسال</th>
                  <th>عدد التقارير</th>
                  <th>رابط المستخدم</th>
                  <th>الإجراءات</th>
                </tr>
              </thead>
              <tbody>
                <tr class="table-row">
                  <td class="table-cell">
                    <input type="checkbox" class="checkbox" />
                  </td>
                  <td class="table-cell">هذه رسالة مبلغ عنها</td>
                  <td class="table-cell">2024-01-15</td>
                  <td class="table-cell">3</td>
                  <td class="table-cell">رابط المستخدم 1</td>
                  <td class="table-cell actions">عرض ، حذف</td>
                </tr>
                <tr class="table-row">
                  <td class="table-cell">
                    <input type="checkbox" class="checkbox" />
                  </td>
                  <td class="table-cell">هذه رسالة مبلغ عنها</td>
                  <td class="table-cell">2024-01-16</td>
                  <td class="table-cell">5</td>
                  <td class="table-cell">رابط المستخدم 2</td>
                  <td class="table-cell actions">عرض ، حذف</td>
                </tr>
                <tr class="table-row">
                  <td class="table-cell">
                    <input type="checkbox" class="checkbox" />
                  </td>
                  <td class="table-cell">هذه رسالة مبلغ عنها</td>
                  <td class="table-cell">2024-01-17</td>
                  <td class="table-cell">2</td>
                  <td class="table-cell">رابط المستخدم 3</td>
                  <td class="table-cell actions">عرض ، حذف</td>
                </tr>
                <tr class="table-row">
                  <td class="table-cell">
                    <input type="checkbox" class="checkbox" />
                  </td>
                  <td class="table-cell">هذه رسالة مبلغ عنها</td>
                  <td class="table-cell">2024-01-18</td>
                  <td class="table-cell">4</td>
                  <td class="table-cell">رابط المستخدم 4</td>
                  <td class="table-cell actions">عرض ، حذف</td>
                </tr>
                <tr class="table-row">
                  <td class="table-cell">
                    <input type="checkbox" class="checkbox" />
                  </td>
                  <td class="table-cell">هذه رسالة مبلغ عنها</td>
                  <td class="table-cell">2024-01-19</td>
                  <td class="table-cell">1</td>
                  <td class="table-cell">رابط المستخدم 5</td>
                  <td class="table-cell actions">عرض ، حذف</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
