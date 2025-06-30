  @extends('layouts.admin')
  @section('title','صراحة - إدارة الرسائل')
  @section('page-css')
  <link rel="stylesheet" href="{{url('css/pages/admin/index.css')}}"/>
  <link rel="stylesheet" href="{{url('css/pages/admin/messages.css')}}"/>
  @endsection

       @section('main')
      <!-- Main Content -->
      <div class="main-content">

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
              placeholder="ابحث  عن رسائل"
            />
          </div>
        </div>

        <!-- Table Section -->
        <div class="table-section">
          <div class="table-container">
            <table class="table">
              <thead class="table-header">
                <tr>
                  <th>محتوى الرسالة</th>
                  <th>المرسل (مجهول)</th>
                  <th>تاريخ الإرسال</th>
                  <th>عدد الإبلاغات</th>
                  <th>الإجراء</th>
                </tr>
              </thead>
              <tbody>
                <tr class="table-row">
                  <td class="table-cell">محتوى الرسالة 1</td>
                  <td class="table-cell">مجهول</td>
                  <td class="table-cell">2024-01-15</td>
                  <td class="table-cell">3</td>
                  <td class="table-cell action">عرض</td>
                </tr>
                <tr class="table-row">
                  <td class="table-cell">محتوى الرسالة 2</td>
                  <td class="table-cell">مجهول</td>
                  <td class="table-cell">2024-01-16</td>
                  <td class="table-cell">5</td>
                  <td class="table-cell action">عرض</td>
                </tr>
                <tr class="table-row">
                  <td class="table-cell">محتوى الرسالة 3</td>
                  <td class="table-cell">مجهول</td>
                  <td class="table-cell">2024-01-17</td>
                  <td class="table-cell">2</td>
                  <td class="table-cell action">عرض</td>
                </tr>
                <tr class="table-row">
                  <td class="table-cell">محتوى الرسالة 4</td>
                  <td class="table-cell">مجهول</td>
                  <td class="table-cell">2024-01-18</td>
                  <td class="table-cell">1</td>
                  <td class="table-cell action">عرض</td>
                </tr>
                <tr class="table-row">
                  <td class="table-cell">محتوى الرسالة 5</td>
                  <td class="table-cell">مجهول</td>
                  <td class="table-cell">2024-01-19</td>
                  <td class="table-cell">4</td>
                  <td class="table-cell action">عرض</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
          <div class="action-buttons-container">
            <button class="action-button delete">حذف الكل</button>
            <button class="action-button clear">تبرئة الكل</button>
          </div>
        </div>
      </div>
        @endsection
