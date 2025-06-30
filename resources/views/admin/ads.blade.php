  @extends('layouts.admin')
  @section('title','صراحة - إدارة الإعلانات')
  @section('page-css')
  <link rel="stylesheet" href="{{url('css/pages/admin/ads.css')}}"/>
  @endsection

       @section('main')
      <!-- Main Content -->
      <main class="main-content">
        <!-- Content Header -->
        <div class="content-header">
          <h2 class="page-title">إدارة الإعلانات</h2>
        </div>

        <!-- Tab Navigation -->
        <div class="tab-navigation">
          <div class="tab-list">
            <a href="#" class="tab-item active">إعلان الراية العلوية</a>
            <a href="#" class="tab-item">إعلان الشريط الأيمن</a>
            <a href="#" class="tab-item">إعلان الشريط الأيسر</a>
            <a href="#" class="tab-item">إعلان داخل المحتوى</a>
            <a href="#" class="tab-item">إعلان تذييل الصفحة</a>
          </div>
        </div>

        <!-- Form Section -->
        <div class="form-section">
          <div class="form-group">
            <label class="form-label">كود الإعلان</label>
            <textarea
              class="form-textarea"
              placeholder="أدخل كود الإعلان هنا..."
            ></textarea>
          </div>
        </div>

        <!-- Toggle Section -->
        <div class="toggle-section">
          <div class="toggle-container">
            <div class="toggle-switch" onclick="toggleSwitch(this)">
              <div class="toggle-knob"></div>
            </div>
          </div>
          <div class="toggle-label">تفعيل الإعلان</div>
        </div>

        <!-- Action Section -->
        <div class="action-section">
          <button class="save-btn">حفظ جميع الإعلانات</button>
        </div>

        <!-- Warning Section -->
        <div class="warning-section">
          <p class="warning-text">يرجى التأكد من أن يكون كود الإعلان صحيح</p>
        </div>
      </main>

    <script>
      function toggleSwitch(element) {
        element.classList.toggle("active");
      }

      // Tab functionality
      document.querySelectorAll(".tab-item").forEach((tab) => {
        tab.addEventListener("click", function (e) {
          e.preventDefault();

          // Remove active class from all tabs
          document
            .querySelectorAll(".tab-item")
            .forEach((t) => t.classList.remove("active"));

          // Add active class to clicked tab
          this.classList.add("active");
        });
      });
    </script>
    @endsection