<!doctype html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>صراحة - إرسال رسالة</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="{{ url('css/globalstyle.css') }}">
    <style>
      /* --- نفس الـ CSS الموجود سابقًا --- */
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        font-family:
          "Cairo",
          "Plus Jakarta Sans",
          system-ui,
          -apple-system,
          sans-serif;
        direction: rtl;
        min-height: 100vh;
        background: #fff;
      }

      .main-container {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
      }

      .main-content {
        flex: 1;
        background: linear-gradient(180deg, #5412eb 0%, #191919 100%);
      }

      .content-area {
        display: flex;
        height: 864px;
        padding: 20px 160px;
        flex-direction: column;
        justify-content: center;
        align-items: center;
      }

      .content-wrapper {
        display: flex;
        height: 695px;
        max-width: 960px;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 100%;
      }

      .profile-section {
        display: flex;
        padding: 16px;
        justify-content: center;
        align-items: flex-start;
        width: 100%;
      }

      .profile-content {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        gap: 16px;
      }

      .profile-info {
        display: flex;
        height: 128px;
        flex-direction: column;
        justify-content: center;
        align-items: flex-end;
      }

      .profile-name {
        width: 226px;
        height: 28px;
        color: #fff;
        text-align: right;
        font-family:
          "Plus Jakarta Sans",
          system-ui,
          -apple-system,
          sans-serif;
        font-size: 22px;
        font-weight: 700;
        line-height: 28px;
      }

      .profile-subtitle {
        color: #b7b7b7;
        font-family:
          "Plus Jakarta Sans",
          system-ui,
          -apple-system,
          sans-serif;
        font-size: 16px;
        font-weight: 400;
        line-height: 24px;
      }

      .profile-avatar {
        width: 128px;
        height: 128px;
        min-height: 128px;
        border-radius: 50%;
      }

      .message-section {
        display: flex;
        max-width: 480px;
        padding: 12px 16px;
        align-items: flex-end;
        align-content: flex-end;
        gap: 16px;
        flex-wrap: wrap;
        width: 100%;
      }

      .message-input {
        display: flex;
        min-width: 160px;
        flex-direction: column;
        align-items: flex-start;
        flex: 1;
      }

      .textarea-wrapper {
        display: flex;
        min-height: 144px;
        padding: 15px;
        align-items: flex-start;
        flex: 1;
        width: 100%;
        border-radius: 8px;
        border: 1px solid #dbdbdb;
        background: #fafafa;
      }

      .message-textarea {
        width: 100%;
        height: 100%;
        background: transparent;
        border: none;
        outline: none;
        resize: none;
        color: #333;
        font-family:
          "Plus Jakarta Sans",
          system-ui,
          -apple-system,
          sans-serif;
        font-size: 14px;
        direction: rtl;
      }

      .message-textarea::placeholder {
        color: #999;
      }

      .help-text {
        display: flex;
        padding: 4px 16px 12px 16px;
        flex-direction: column;
        align-items: center;
        width: 100%;
      }

      .help-text p {
        color: #b7b7b7;
        text-align: center;
        font-family:
          "Plus Jakarta Sans",
          system-ui,
          -apple-system,
          sans-serif;
        font-size: 14px;
        font-weight: 400;
        line-height: 21px;
        width: 100%;
      }

      .send-section {
        display: flex;
        padding: 12px 16px;
        justify-content: center;
        align-items: flex-start;
        width: 100%;
      }

      .send-button {
        display: flex;
        height: 40px;
        min-width: 84px;
        max-width: 480px;
        padding: 0 16px;
        justify-content: center;
        align-items: center;
        border-radius: 8px;
        background: linear-gradient(180deg, #141414 1.25%, #5412eb 100%);
        border: none;
        cursor: pointer;
      }

      .send-button:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(84, 18, 235, 0.3);
      }

      .send-content {
        display: flex;
        width: 80px;
        justify-content: center;
        align-items: flex-start;
        gap: 8px;
      }

      .send-text {
        color: #fff;
        font-family:
          Cairo,
          system-ui,
          -apple-system,
          sans-serif;
        font-size: 14px;
        font-weight: 700;
        line-height: 21px;
      }

      .send-icon {
        width: 24px;
        height: 24px;
      }

      .footer {
        display: flex;
        height: 59px;
        flex-direction: column;
        justify-content: center;
        width: 100%;
        color: #d7e4ff;
        text-align: center;
        font-family: "Noto Serif", serif;
        font-size: 16px;
        font-weight: 400;
        line-height: 24px;
      }

      @media (max-width: 1280px) {
        .header {
          padding: 0 80px;
        }
        .content-area {
          padding: 20px 80px;
        }
      }

      @media (max-width: 768px) {
        .header {
          padding: 0 24px;
        }
        .header-content {
          width: 100%;
          flex-direction: column;
          gap: 16px;
          height: auto;
          padding: 16px 0;
        }
        .header-left {
          width: 100%;
          flex-direction: column;
          gap: 16px;
        }
        .navigation {
          width: 100%;
          gap: 20px;
        }
        .content-area {
          padding: 20px 24px;
          height: auto;
        }
        .profile-content {
          flex-direction: column;
          align-items: center;
          text-align: center;
        }
        .profile-info {
          align-items: center;
          order: 2;
        }
        .profile-name {
          text-align: center;
        }
        .message-section {
          max-width: 100%;
        }
      }

      @media (max-width: 480px) {
        .header {
          padding: 0 16px;
        }
        .content-area {
          padding: 20px 16px;
        }
        .navigation {
          gap: 12px;
          flex-wrap: wrap;
        }
        .nav-item span {
          font-size: 12px;
        }
        .profile-name {
          font-size: 20px;
          width: auto;
        }
        .profile-subtitle {
          font-size: 14px;
        }
        .profile-avatar {
          width: 96px;
          height: 96px;
        }
      }
    </style>
  </head>
  <body>
    <!-- Header -->
    <header class="header">
      <div class="container">
        <div class="header-content">
          <a href="/" class="logo">
            <div class="logo">
              <img
                src="https://cdn.builder.io/api/v1/image/assets/TEMP/5029f4236f65d0d4d941d8086f6901a1afaa86c0"
                alt="Logo"
                class="logo-img"
              />
              <h1 class="logo-text">صراحة</h1>
            </div>
          </a>

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

    <!-- Main content with purple gradient background -->
    <div class="main-content">
      <div class="content-area">
        <div class="content-wrapper">
          <!-- Profile Section -->
          <div class="profile-section">
            <div class="profile-content">
              <div class="profile-info">
                <!-- بدل النص الثابت هنا استبدل باسم المستخدم الحقيقي -->
                <div class="profile-name">{{ $user->name ?? 'المستخدم' }}</div>
                <div class="profile-subtitle">قم بارسال رسالتك المجهولة</div>
              </div>
              <img
                class="profile-avatar"
                src="{{ $user->avatar_url ?? 'https://cdn.builder.io/api/v1/image/assets/TEMP/3c96996ca3c0142be6a28655f2bc050756ff0b8a?width=256' }}"
                alt="{{ $user->name ?? 'المستخدم' }}"
              />
            </div>
          </div>

          <!-- Message Input Section -->
          <form action="{{ route('send.message', ['identifier' => $user->username]) }}" method="post">
            @csrf
            <div class="message-section">
              <div class="message-input">
                <div class="textarea-wrapper">
                  <textarea
                    class="message-textarea"
                    placeholder="اكتب رسالتك هنا..."
                    id="messageInput"
                    name="message-content"
                    required
                    maxlength="1000"
                  ></textarea>
                </div>
              </div>
            </div>

            <!-- Help Text -->
            <div class="help-text">
              <p>قم بارسال ما تريدة بصدق وشفافية</p>
            </div>

            <!-- Send Button -->
            <div class="send-section">
              <button class="send-button" type="submit">
                <div class="send-content">
                  <span class="send-text">إرسال الآن</span>
                  <img
                    src="https://cdn.builder.io/api/v1/image/assets/TEMP/7e6ec1ac7a9c7d35064de79f1247d89b68d60744?width=48"
                    class="send-icon"
                    alt="Send"
                  />
                </div>
              </button>
            </div>
          </form>
        </div>

        <!-- Footer -->
        <div class="footer">جميع الحقوق محفوظة - صراحة © 2025</div>
      </div>
    </div>
  </body>
</html>
