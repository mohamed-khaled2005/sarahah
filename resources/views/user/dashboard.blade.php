@extends('layouts.user')
@section('title','صراحة - لوحة التحكم')
@section('page-css')
    <link rel="stylesheet" href="{{ url('css/pages/user/index.css') }}">
@endsection
@section('main')
      <!-- Recent Activities Section -->
      <div class="activities-title">
        <h2 class="font-plus-jakarta">الأحداث الأخيرة</h2>
      </div>

      <div class="activities-list">
        <!-- Activity Item 1 -->
        <div class="activity-item">
          <div class="activity-content">
            <div class="activity-text font-plus-jakarta">
              رسالة جديدة من صديق
            </div>
            <div class="activity-time font-plus-jakarta">منذ 5 دقائق</div>
          </div>
          <div class="activity-avatar">
            <img
              src="https://cdn.builder.io/api/v1/image/assets/TEMP/f9a99e12816791102350b00cdad9726078d52f83"
              alt="User"
              class="avatar-img"
            />
            <div class="avatar-line long"></div>
          </div>
        </div>

        <!-- Activity Item 2 -->
        <div class="activity-item">
          <div class="activity-content">
            <div class="activity-text font-plus-jakarta">
              رسالة جديدة من عابد الله
            </div>
            <div class="activity-time light font-plus-jakarta">
              منذ 10 دقائق
            </div>
          </div>
          <div class="activity-avatar with-line-top">
            <div class="avatar-line short"></div>
            <img
              src="https://cdn.builder.io/api/v1/image/assets/TEMP/3afb99ff5ed489f6d568ea1189e0885ba18c3f9f"
              alt="User"
              class="avatar-img"
            />
            <div class="avatar-line long"></div>
          </div>
        </div>

        <!-- Activity Item 3 -->
        <div class="activity-item">
          <div class="activity-content">
            <div class="activity-text font-plus-jakarta">
              رسالة جديدة من محمد
            </div>
            <div class="activity-time font-plus-jakarta">منذ 15 دقائق</div>
          </div>
          <div class="activity-avatar with-line-top">
            <div class="avatar-line short"></div>
            <img
              src="https://cdn.builder.io/api/v1/image/assets/TEMP/66415bb9fb29b2becd308be4a322a5f74308a268"
              alt="User"
              class="avatar-img"
            />
            <div class="avatar-line long"></div>
          </div>
        </div>
      </div>
   
    <script>
      function copyToClipboard() {
        const urlText = document.getElementById("shareUrl").textContent;
        const copyBtn = document.getElementById("copyBtnText");

        if (navigator.clipboard && navigator.clipboard.writeText) {
          navigator.clipboard
            .writeText(urlText)
            .then(() => {
              copyBtn.textContent = "تم النسخ!";
              setTimeout(() => {
                copyBtn.textContent = "نسخ الرابط";
              }, 2000);
            })
            .catch(() => {
              fallbackCopyTextToClipboard(urlText, copyBtn);
            });
        } else {
          fallbackCopyTextToClipboard(urlText, copyBtn);
        }
      }

      function fallbackCopyTextToClipboard(text, btn) {
        const textArea = document.createElement("textarea");
        textArea.value = text;
        textArea.style.top = "0";
        textArea.style.left = "0";
        textArea.style.position = "fixed";

        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();

        try {
          const successful = document.execCommand("copy");
          if (successful) {
            btn.textContent = "تم النسخ!";
            setTimeout(() => {
              btn.textContent = "نسخ الرابط";
            }, 2000);
          }
        } catch (err) {
          console.error("Fallback: Oops, unable to copy", err);
        }

        document.body.removeChild(textArea);
      }
    </script>
  </body>
</html>
@endsection

@section("index-status")

          <!-- Stats Cards -->
          <div class="stats-grid">
                <div class="stat-card">
              <div class="stat-title font-plus-jakarta">رسائل اليوم</div>
              <div class="stat-value font-plus-jakarta">{{$todayMessagesCount}}</div>
            </div>
              <div class="stat-card">
              <div class="stat-title font-plus-jakarta">إجمالي الرسائل</div>
              <div class="stat-value font-plus-jakarta">{{$totalMessagesCount}}</div>
            </div>
                 <div class="stat-card">
              <div class="stat-title font-plus-jakarta">الرسائل المميزة</div>
              <div class="stat-value font-plus-jakarta">{{$featuredMessagesCount}}</div>
            </div>
            <div class="stat-card">
              <div class="stat-title font-plus-jakarta">آخر رسالة</div>
              <div class="stat-value font-plus-jakarta">{{$lastMessageTime}}</div>
            </div>
       
          
        
          </div>

          

          <!-- URL Field -->
          <div class="url-field">
            <span class="url-text font-plus-jakarta" id="shareUrl"
              >https://example.com/share/id=434</span
            >
          </div>
        <!-- Share Section -->
          <div class="share-section">
            <button class="share-btn" onclick="copyToClipboard()">
              <svg
                class="icon-white"
                xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="17"
                viewBox="0 0 20 17"
                fill="none"
              >
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M19.5306 5.78063L15.0306 10.2806C14.7376 10.5737 14.2624 10.5737 13.9694 10.2806C13.6763 9.98757 13.6763 9.51243 13.9694 9.21937L17.1897 6H13.4688C9.70591 5.99896 6.41915 8.54415 5.47844 12.1875C5.37488 12.5888 4.96564 12.8301 4.56437 12.7266C4.16311 12.623 3.92176 12.2138 4.02531 11.8125C5.13533 7.50544 9.02096 4.49662 13.4688 4.5H17.1916L13.9694 1.28062C13.6763 0.987569 13.6763 0.512431 13.9694 0.219375C14.2624 -0.0736809 14.7376 -0.0736809 15.0306 0.219375L19.5306 4.71937C19.6715 4.86005 19.7506 5.05094 19.7506 5.25C19.7506 5.44906 19.6715 5.63995 19.5306 5.78063ZM16 15H1.75V3.75C1.75 3.33579 1.41421 3 1 3C0.585786 3 0.25 3.33579 0.25 3.75V15C0.25 15.8284 0.921573 16.5 1.75 16.5H16C16.4142 16.5 16.75 16.1642 16.75 15.75C16.75 15.3358 16.4142 15 16 15Z"
                  fill="white"
                />
              </svg>
               <span class="copy-btn-text font-plus-jakarta" id="copyBtnText"
                >نسخ الرابط</span
              >
            </button>
          </div>

@endsection