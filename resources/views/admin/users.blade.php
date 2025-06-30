  @extends('layouts.admin')
  @section('title','صراحة - إدارة المستخدمين')
  @section('page-css')
  <link rel="stylesheet" href="{{url('css/pages/admin/index.css')}}"/>
  <link rel="stylesheet" href="{{url('css/pages/admin/users.css')}}"/>
  @endsection
        @section('main')
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
        @endsection
