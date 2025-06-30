  @extends('layouts.admin')
  @section('title','صراحة - التقارير')
  @section('page-css')
  <link rel="stylesheet" href="{{url('css/pages/admin/reports.css')}}"/>
  @endsection

      @section('main')
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
      @endsection