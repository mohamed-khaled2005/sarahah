
  @extends('layouts.admin')
  @section('title','صراحة - إعدادات الموقع')
  @section('page-css')
  <link rel="stylesheet" href="{{url('css/pages/admin/index.css')}}"/>
  <link rel="stylesheet" href="{{url('css/pages/admin/settings.css')}}"/>
  @endsection
        @section('main')
      <!-- Main Content -->
      <main class="main-content">
        <!-- Content Header -->
        <div class="content-header">
          <h2 class="page-title">إعدادات الموقع</h2>
        </div>

        <!-- Logo Section -->
        <div class="section">
          <div class="section-header">
            <h3 class="section-title">شعار الموقع</h3>
          </div>
          <div class="section-content">
            <div class="logo-upload" onclick="handleLogoUpload()">
              <div class="logo-upload-content">
                <div class="logo-upload-title">اضف شعار الموقع</div>
                <div class="logo-upload-subtitle">
                  استخدم صورة بجودة واضحة لشعار الموقع الخاص بك
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Links Section -->
        <div class="section">
          <div class="section-header">
            <h3 class="section-title">الروابط</h3>
          </div>
          <div class="input-container">
            <div class="input-field">
              <input
                type="url"
                class="input"
                placeholder="رابط فيس بوك"
                value=""
              />
            </div>
          </div>
          <div class="input-container">
            <div class="input-field">
              <input
                type="url"
                class="input filled"
                placeholder="رابط تويتر"
                value="رابط تويتر"
              />
            </div>
          </div>
          <div class="input-container">
            <div class="input-field">
              <input
                type="url"
                class="input privacy"
                placeholder="رابط سياسة الخصوصية"
                value="رابط سياسة الخصوصية"
              />
            </div>
          </div>
        </div>

        <!-- Messages Section -->
        <div class="section">
          <div class="section-header">
            <h3 class="section-title">الرسائل</h3>
          </div>
          <div class="input-container">
            <div class="input-field">
              <input
                type="number"
                class="input privacy"
                placeholder="الحد الأقصى للرسائل يومياً"
                value="الحد الأقصى للرسائل يومياً"
              />
            </div>
          </div>
        </div>

        <!-- Toggle Section -->
        <div class="toggle-section">
          <div class="toggle-container">
            <div class="toggle-switch" onclick="toggleSwitch(this)">
              <div class="toggle-knob"></div>
            </div>
          </div>
          <div class="toggle-label">تفعيل / تعطيل الإعلانات</div>
        </div>

        <!-- Save Button -->
        <div class="save-section">
          <button class="save-btn" onclick="saveSettings()">
            حفظ الإعدادات
          </button>
        </div>
      </main>
      <script>
      function toggleSwitch(element) {
        element.classList.toggle("active");
      }

      function handleLogoUpload() {
        const input = document.createElement("input");
        input.type = "file";
        input.accept = "image/*";
        input.onchange = function (e) {
          const file = e.target.files[0];
          if (file) {
            console.log("Logo uploaded:", file.name);
            // Add logo preview functionality here
          }
        };
        input.click();
      }

      function saveSettings() {
        console.log("Settings saved");
        // Add save settings functionality here

        // Show success message
        alert("تم حفظ الإعدادات بنجاح!");
      }

      // Form validation and interaction
      document.querySelectorAll(".input").forEach((input) => {
        input.addEventListener("focus", function () {
          this.style.borderColor = "#3d99f5";
          this.style.background = "#fff";
        });

        input.addEventListener("blur", function () {
          this.style.borderColor = "#d6d9e3";
          this.style.background = "#fafafa";
        });

        input.addEventListener("input", function () {
          if (this.value.trim() !== "") {
            this.classList.add("filled");
          } else {
            this.classList.remove("filled");
          }
        });
      });
      </script>
      @endsection



