@extends('layouts.user')
@section('title','صراحة - الإعدادات')
@section('page-css')
    <link rel="stylesheet" href="{{ url('css/pages/user/settings.css') }}">
@endsection
@section('main')
      <!-- Main content -->
      <main class="main-content">
        <div class="content-wrapper">
          <div class="settings-container">
            <!-- Message Settings Section -->
            <div class="settings-section">
              <div class="section-title">
                <h2>إعدادات الرسائل</h2>
              </div>
              <div class="section-content">
                <div class="settings-item">
                  <div class="settings-toggle">
                    <div
                      class="toggle-switch active"
                      onclick="toggleSwitch(this)"
                    >
                      <div class="toggle-handle"></div>
                    </div>
                  </div>
                  <div class="settings-content">
                    <div class="content-title">
                      <h3>الرسائل المجهولة</h3>
                    </div>
                    <div class="content-description">
                      <p>تفعيل الرسائل المجهولة من المستخدمين الآخرين</p>
                    </div>
                  </div>
                </div>

                <div class="settings-item">
                  <div class="settings-toggle">
                    <div
                      class="toggle-switch active"
                      onclick="toggleSwitch(this)"
                    >
                      <div class="toggle-handle"></div>
                    </div>
                  </div>
                  <div class="settings-content">
                    <div class="content-title">
                      <h3>تصفية الكلمات البذيئة</h3>
                    </div>
                    <div class="content-description">
                      <p>تفعيل تصفية الكلمات البذيئة في الرسائل</p>
                    </div>
                  </div>
                </div>

                <div class="settings-item">
                  <div class="settings-toggle">
                    <div
                      class="toggle-switch active"
                      onclick="toggleSwitch(this)"
                    >
                      <div class="toggle-handle"></div>
                    </div>
                  </div>
                  <div class="settings-content">
                    <div class="content-title">
                      <h3>إشعارات الرسائل</h3>
                    </div>
                    <div class="content-description">
                      <p>تفعيل الإشعارات للرسائل الجديدة</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Privacy Section -->
            <div class="settings-section">
              <div class="section-title">
                <h2>الخصوصية</h2>
              </div>
              <div class="section-content">
                <div class="settings-item">
                  <div class="settings-toggle">
                    <div
                      class="toggle-switch active"
                      onclick="toggleSwitch(this)"
                    >
                      <div class="toggle-handle"></div>
                    </div>
                  </div>
                  <div class="settings-content">
                    <div class="content-title">
                      <h3>إخفاء الاسم</h3>
                    </div>
                    <div class="content-description">
                      <p>إخفاء اسم المستخدم عن المستخدمين الآخرين</p>
                    </div>
                  </div>
                </div>

                <div class="settings-item">
                  <div class="settings-toggle">
                    <button
                      class="view-button"
                      onclick="viewIncomingMessages()"
                    >
                      View
                    </button>
                  </div>
                  <div class="settings-content">
                    <div class="content-title">
                      <h3>الرسائل الواردة</h3>
                    </div>
                    <div class="content-description">
                      <p>تحديد من يمكنه إرسال الرسائل</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Appearance Section -->
            <div class="settings-section">
              <div class="section-title">
                <h2>المظهر</h2>
              </div>
              <div class="section-content">
                <div class="settings-item">
                  <div class="settings-button">
                    <button class="action-button" onclick="selectThemeColor()">
                      dropdown
                    </button>
                  </div>
                  <div class="settings-content">
                    <div class="content-title">
                      <h3>لون الموضوع</h3>
                    </div>
                    <div class="content-description">
                      <p>اختر لون الموضوع الرئيسي</p>
                    </div>
                  </div>
                </div>

                <div class="settings-item">
                  <div class="settings-button">
                    <button class="action-button" onclick="uploadBackground()">
                      تحميل
                    </button>
                  </div>
                  <div class="settings-content">
                    <div class="content-title">
                      <h3>صورة خلفية</h3>
                    </div>
                    <div class="content-description">
                      <p>تحميل صورة خلفية للملف الشخصي</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>


    <script>
      // Toggle switch functionality
      function toggleSwitch(element) {
        element.classList.toggle("active");

        // You can add more functionality here, like saving the state
        const isActive = element.classList.contains("active");
        console.log("Toggle switched:", isActive);
      }

      // Navigation tab switching
      function switchTab(tabName) {
        // Remove active class from all tabs
        const tabs = document.querySelectorAll(".nav-tab");
        tabs.forEach((tab) => tab.classList.remove("active"));

        // Add active class to clicked tab
        event.target.classList.add("active");

        console.log("Switched to tab:", tabName);
        // You can add navigation logic here
      }

      // Button click handlers
      function viewIncomingMessages() {
        console.log("View incoming messages clicked");
        // Add your logic here
      }

      function selectThemeColor() {
        console.log("Select theme color clicked");
        // Add your logic here
      }

      function uploadBackground() {
        console.log("Upload background clicked");
        // Add your logic here
      }

      // Initialize the page
      document.addEventListener("DOMContentLoaded", function () {
        console.log("Saraha Settings Page Loaded");
      });
    </script>
@endsection