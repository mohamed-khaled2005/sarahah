<!doctype html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield("title")</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    @yield('page-css')
  </head>
  <body>
    <!-- Header -->
    <header class="header">
      <div class="container">
        <div class="header-content">
          <a href="/" class="logo"><div class="logo">
            <img
              src="https://cdn.builder.io/api/v1/image/assets/TEMP/5029f4236f65d0d4d941d8086f6901a1afaa86c0"
              alt="Logo"
              class="logo-img"
            />
            <h1 class="logo-text">صراحة</h1>
          </div></a>
         

          <!-- Navigation -->
          <nav class="nav">
            <div class="nav-item">
              <svg width="19" height="18" viewBox="0 0 27 26" fill="none">
                <path
                  d="M14.5878 0.378142C13.9774 -0.126047 13.0226 -0.126047 12.4122 0.378142L4.74334 6.71297C4.26885 7.10492 4 7.65027 4 8.22077V15.925C4 17.0709 5.06332 18 6.375 18H8.75C10.0617 18 11.125 17.0709 11.125 15.925V12.4666C11.125 12.0846 11.4794 11.775 11.9167 11.775H15.0833C15.5206 11.775 15.875 12.0846 15.875 12.4666V15.925C15.875 17.0709 16.9384 18 18.25 18H20.625C21.9366 18 23 17.0709 23 15.925V8.22077C23 7.65027 22.7312 7.10492 22.2566 6.71297L14.5878 0.378142Z"
                  fill="black"
                />
              </svg>
              <span>الرئيسية</span>
            </div>
            <div class="nav-item">
              <svg width="25" height="24" viewBox="0 0 25 24" fill="none">
                <path
                  d="M8.5 5C8.5 4.44772 8.94772 4 9.5 4H11.0858C11.351 4 11.6054 4.10536 11.7929 4.29289L12.2071 4.70711C12.3946 4.89464 12.649 5 12.9142 5H15.5C16.0523 5 16.5 5.44772 16.5 6V10C16.5 10.5523 16.0523 11 15.5 11H9.5C8.94772 11 8.5 10.5523 8.5 10V5Z"
                  fill="#222222"
                />
                <path
                  d="M14.5 14C14.5 13.4477 14.9477 13 15.5 13H17.0858C17.351 13 17.6054 13.1054 17.7929 13.2929L18.2071 13.7071C18.3946 13.8946 18.649 14 18.9142 14H21.5C22.0523 14 22.5 14.4477 22.5 15V19C22.5 19.5523 22.0523 20 21.5 20H15.5C14.9477 20 14.5 19.5523 14.5 19V14Z"
                  fill="#222222"
                />
                <path
                  d="M2.5 14C2.5 13.4477 2.94772 13 3.5 13H5.08579C5.351 13 5.60536 13.1054 5.79289 13.2929L6.20711 13.7071C6.39464 13.8946 6.649 14 6.91421 14H9.5C10.0523 14 10.5 14.4477 10.5 15V19C10.5 19.5523 10.0523 20 9.5 20H3.5C2.94772 20 2.5 19.5523 2.5 19V14Z"
                  fill="#222222"
                />
              </svg>
              <span>كيف يعمل</span>
            </div>
            <div class="nav-item">
              <img
                src="https://cdn.builder.io/api/v1/image/assets/TEMP/88db2715c998c53f7941016b314afefdedf1b4da"
                alt=""
              />
              <span>مميزات</span>
            </div>
          </nav>

          <!-- Auth Buttons -->
          <div class="auth-buttons">
            <div class="auth-item">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path
                  d="M11.9997 15C12.4463 15 12.8902 15.0264 13.3278 15.0771C11.9947 15.3824 10.9997 16.5743 10.9997 18C10.9997 19.6568 12.3429 20.9999 13.9997 21H14.9997V21.0723C11.4434 21.3576 7.85662 21.1364 4.3483 20.4053C3.79567 20.2901 3.46657 19.712 3.74088 19.2188C4.34646 18.1311 5.30072 17.1747 6.52116 16.4463C8.09286 15.5083 10.0186 15 11.9997 15Z"
                  fill="#222222"
                />
                <path
                  d="M18 14L18 22"
                  stroke="#222222"
                  stroke-width="2.5"
                  stroke-linecap="round"
                />
                <path
                  d="M22 18L14 18"
                  stroke="#222222"
                  stroke-width="2.5"
                  stroke-linecap="round"
                />
                <circle cx="12" cy="8" r="5" fill="#222222" />
              </svg>
              <span>تسجيل</span>
            </div>
            <div class="auth-item">
              <img
                src="https://cdn.builder.io/api/v1/image/assets/TEMP/a6ae1ad276a92fa031b9cca3906be42279304e59"
                alt=""
              />
              <span>دخول</span>
            </div>
          </div>
        </div>
      </div>
    </header>


    @yield('main')

    <!-- Footer -->
    <footer class="footer">
      <div class="container">
        <div class="footer-content">
          <div class="footer-links">
            <span>من نحن</span>
            <span>سياسة الخصوصية</span>
            <span>شروط الأستخدام</span>
            <span>تواصل معنا</span>
          </div>
          <p class="footer-copyright">جميع الحقوق محفوظة - صراحة © 2025</p>
        </div>
      </div>
    </footer>

    <script src="script.js"></script>
  </body>
</html>
