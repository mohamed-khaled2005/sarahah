  @extends('layouts.admin')
  @section('title','صراحة - إدارة المقالات')
  @section('page-css')
  <link rel="stylesheet" href="{{url('css/pages/admin/posts.css')}}"/>
  @endsection

      @section('main')
      <!-- Main Content -->
      <main class="main-content">
        <!-- Content Header -->
        <div class="content-header">
          <h2 class="page-title">إدارة المقالات</h2>
          <button class="add-btn">+ إضافة مقال جديد</button>
        </div>

        <!-- Search Section -->
        <div class="search-section">
          <div class="search-container">
            <div class="search-wrapper">
              <div class="search-icon">
                <svg
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M19.5306 18.4694L14.8366 13.7762C17.6629 10.383 17.3204 5.36693 14.0591 2.38935C10.7978 -0.588237 5.77134 -0.474001 2.64867 2.64867C-0.474001 5.77134 -0.588237 10.7978 2.38935 14.0591C5.36693 17.3204 10.383 17.6629 13.7762 14.8366L18.4694 19.5306C18.7624 19.8237 19.2376 19.8237 19.5306 19.5306C19.8237 19.2376 19.8237 18.7624 19.5306 18.4694ZM1.75 8.5C1.75 4.77208 4.77208 1.75 8.5 1.75C12.2279 1.75 15.25 4.77208 15.25 8.5C15.25 12.2279 12.2279 15.25 8.5 15.25C4.77379 15.2459 1.75413 12.2262 1.75 8.5Z"
                    fill="#61668A"
                  />
                </svg>
              </div>
              <input
                type="text"
                class="search-input"
                placeholder="ابحث عن مقال"
              />
            </div>
          </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
          <button class="filter-dropdown">
            <span>حسب التصنيف</span>
            <svg
              width="14"
              height="9"
              viewBox="0 0 14 9"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M13.6922 1.94219L7.44219 8.19219C7.32496 8.30955 7.16588 8.37549 7 8.37549C6.83412 8.37549 6.67504 8.30955 6.55781 8.19219L0.307812 1.94219C0.0635991 1.69797 0.0635991 1.30203 0.307812 1.05781C0.552026 0.813599 0.947974 0.813599 1.19219 1.05781L7 6.86641L12.8078 1.05781C13.052 0.813599 13.448 0.813599 13.6922 1.05781C13.9364 1.30203 13.9364 1.69797 13.6922 1.94219Z"
                fill="#121217"
              />
            </svg>
          </button>
          <button class="filter-dropdown">
            <span>حسب الكاتب</span>
            <svg
              width="14"
              height="9"
              viewBox="0 0 14 9"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M13.6922 1.94219L7.44219 8.19219C7.32496 8.30955 7.16588 8.37549 7 8.37549C6.83412 8.37549 6.67504 8.30955 6.55781 8.19219L0.307812 1.94219C0.0635991 1.69797 0.0635991 1.30203 0.307812 1.05781C0.552026 0.813599 0.947974 0.813599 1.19219 1.05781L7 6.86641L12.8078 1.05781C13.052 0.813599 13.448 0.813599 13.6922 1.05781C13.9364 1.30203 13.9364 1.69797 13.6922 1.94219Z"
                fill="#121217"
              />
            </svg>
          </button>
          <button class="filter-dropdown">
            <span>حسب التاريخ</span>
            <svg
              width="14"
              height="9"
              viewBox="0 0 14 9"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M13.6922 1.94219L7.44219 8.19219C7.32496 8.30955 7.16588 8.37549 7 8.37549C6.83412 8.37549 6.67504 8.30955 6.55781 8.19219L0.307812 1.94219C0.0635991 1.69797 0.0635991 1.30203 0.307812 1.05781C0.552026 0.813599 0.947974 0.813599 1.19219 1.05781L7 6.86641L12.8078 1.05781C13.052 0.813599 13.448 0.813599 13.6922 1.05781C13.9364 1.30203 13.9364 1.69797 13.6922 1.94219Z"
                fill="#121217"
              />
            </svg>
          </button>
        </div>

        <!-- Table Section -->
        <div class="table-section">
          <div class="table-container">
            <table class="table">
              <thead class="table-header">
                <tr>
                  <th style="width: 75px">✅ تحديد</th>
                  <th style="width: 154px">📝 عنوان المقال</th>
                  <th style="width: 142px">🗒️ التصنيف</th>
                  <th style="width: 149px">✍️ الكاتب</th>
                  <th style="width: 137px">📅 تاريخ النشر</th>
                  <th style="width: 149px">📈 عدد القراءات</th>
                  <th style="width: 120px" class="actions">⚙️ الإجراءات</th>
                </tr>
              </thead>
              <tbody class="table-body">
                <tr>
                  <td>
                    <input type="checkbox" class="checkbox" />
                  </td>
                  <td>الصحة النفسية وأهميتها في العمل</td>
                  <td>
                    <div class="category-tag">الصحة</div>
                  </td>
                  <td class="author">Fatima</td>
                  <td class="date">2024-01-15</td>
                  <td class="reads">1200</td>
                  <td class="actions">✏️ تعديل | 🗑️ حذف | 👁️ عرض</td>
                </tr>
                <tr>
                  <td>
                    <input type="checkbox" class="checkbox" />
                  </td>
                  <td>تطوير التطبيقات في العمل</td>
                  <td>
                    <div class="category-tag">الإنتاجية</div>
                  </td>
                  <td class="author">Ahmed</td>
                  <td class="date">2024-02-20</td>
                  <td class="reads">850</td>
                  <td class="actions">✏️ تعديل | 🗑️ حذف | 👁️ عرض</td>
                </tr>
                <tr>
                  <td>
                    <input type="checkbox" class="checkbox" />
                  </td>
                  <td>تقنيات تركيز على العمل</td>
                  <td>
                    <div class="category-tag">الإنتاجية</div>
                  </td>
                  <td class="author">Layla</td>
                  <td class="date">2024-03-10</td>
                  <td class="reads">1500</td>
                  <td class="actions">✏️ تعديل | 🗑️ حذف | 👁️ عرض</td>
                </tr>
                <tr>
                  <td>
                    <input type="checkbox" class="checkbox" />
                  </td>
                  <td>التعامل مع الضغوط في العمل</td>
                  <td>
                    <div class="category-tag">الإنتاجية</div>
                  </td>
                  <td class="author">Omar</td>
                  <td class="date">2024-04-05</td>
                  <td class="reads">950</td>
                  <td class="actions">✏️ تعديل | 🗑️ حذف | 👁️ عرض</td>
                </tr>
                <tr>
                  <td>
                    <input type="checkbox" class="checkbox" />
                  </td>
                  <td>التواصل في العمل</td>
                  <td>
                    <div class="category-tag">الإنتاجية</div>
                  </td>
                  <td class="author">Sara</td>
                  <td class="date">2024-05-12</td>
                  <td class="reads">1100</td>
                  <td class="actions">✏️ تعديل | 🗑️ حذف | 👁️ عرض</td>
                </tr>
                <tr>
                  <td>
                    <input type="checkbox" class="checkbox" />
                  </td>
                  <td>التعاون في العمل</td>
                  <td>
                    <div class="category-tag">الإنتاجية</div>
                  </td>
                  <td class="author">Youssef</td>
                  <td class="date">2024-06-20</td>
                  <td class="reads">1300</td>
                  <td class="actions">✏️ تعديل | 🗑️ حذف | 👁️ عرض</td>
                </tr>
                <tr>
                  <td>
                    <input type="checkbox" class="checkbox" />
                  </td>
                  <td>التفكير الإبداعي في العمل</td>
                  <td>
                    <div class="category-tag">الإنتاجية</div>
                  </td>
                  <td class="author">Nour</td>
                  <td class="date">2024-07-15</td>
                  <td class="reads">1000</td>
                  <td class="actions">✏️ تعديل | 🗑️ حذف | 👁️ عرض</td>
                </tr>
                <tr>
                  <td>
                    <input type="checkbox" class="checkbox" />
                  </td>
                  <td>التعلم من الأخطاء في العمل</td>
                  <td>
                    <div class="category-tag">الإنتاجية</div>
                  </td>
                  <td class="author">Ali</td>
                  <td class="date">2024-08-01</td>
                  <td class="reads">1400</td>
                  <td class="actions">✏️ تعديل | 🗑️ حذف | 👁️ عرض</td>
                </tr>
                <tr>
                  <td>
                    <input type="checkbox" class="checkbox" />
                  </td>
                  <td>التقدم في العمل</td>
                  <td>
                    <div class="category-tag">الإنتاجية</div>
                  </td>
                  <td class="author">Salma</td>
                  <td class="date">2024-09-10</td>
                  <td class="reads">1600</td>
                  <td class="actions">✏️ تعديل | 🗑️ حذف | 👁️ عرض</td>
                </tr>
                <tr>
                  <td>
                    <input type="checkbox" class="checkbox" />
                  </td>
                  <td>التعامل مع التوتر في العمل</td>
                  <td>
                    <div class="category-tag">الإنتاجية</div>
                  </td>
                  <td class="author">Karim</td>
                  <td class="date">2024-10-05</td>
                  <td class="reads">1250</td>
                  <td class="actions">✏️ تعديل | 🗑️ حذف | 👁️ عرض</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </main>
      <script>
      // Filter dropdown functionality
      document.querySelectorAll(".filter-dropdown").forEach((dropdown) => {
        dropdown.addEventListener("click", function () {
          console.log("Filter clicked:", this.textContent);
          // Add dropdown menu functionality here
        });
      });

      // Checkbox functionality
      document.querySelectorAll(".checkbox").forEach((checkbox) => {
        checkbox.addEventListener("change", function () {
          console.log("Checkbox changed:", this.checked);
        });
      });

      // Add new article button
      document.querySelector(".add-btn").addEventListener("click", function () {
        console.log("Add new article clicked");
        // Add navigation to article creation page
      });

      // Action buttons functionality
      document.querySelectorAll(".actions").forEach((action) => {
        action.addEventListener("click", function (e) {
          if (e.target.textContent.includes("تعديل")) {
            console.log("Edit clicked");
          } else if (e.target.textContent.includes("حذف")) {
            console.log("Delete clicked");
          } else if (e.target.textContent.includes("عرض")) {
            console.log("View clicked");
          }
        });
      });

      // Search functionality
      document
        .querySelector(".search-input")
        .addEventListener("input", function (e) {
          console.log("Search:", e.target.value);
          // Add search filtering logic here
        });
      </script>
  @endsection