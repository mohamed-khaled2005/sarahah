<!doctype html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>إعدادات الموقع - صراحة</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
      rel="stylesheet"
    />
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        font-family:
          "Plus Jakarta Sans",
          -apple-system,
          Roboto,
          Helvetica,
          sans-serif;
        background-color: #fafafa;
        direction: rtl;
        min-height: 100vh;
      }

      .font-cairo {
        font-family:
          "Cairo",
          -apple-system,
          Roboto,
          Helvetica,
          sans-serif;
      }

      /* Header */
      .header {
        background-color: #f7fafa;
        border-bottom: 1px solid #e5e8eb;
        padding: 12px 44px;
      }

      .header-content {
        max-width: 1280px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
      }

      .logo-section {
        display: flex;
        align-items: center;
        gap: 8px;
      }

      .logo-section img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
      }

      .logo-section h1 {
        font-size: 23px;
        font-weight: 700;
        color: #0d121c;
        line-height: 1.5;
      }

      .header-actions {
        display: flex;
        align-items: center;
        gap: 36px;
      }

      .notification-btn {
        background: #e8edf2;
        border-radius: 12px;
        padding: 8px 12px;
        display: flex;
        align-items: center;
        gap: 8px;
      }

      .notification-btn svg {
        width: 20px;
        height: 20px;
        fill: #0d141c;
      }

      .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
      }

      /* Main Layout */
      .main-layout {
        max-width: 1280px;
        margin: 0 auto;
        display: flex;
        min-height: calc(100vh - 67px);
      }

      /* Sidebar */
      .sidebar {
        width: 320px;
        background-color: #fafafa;
        padding: 16px;
        min-height: 700px;
      }

      .sidebar-content {
        background-color: #fafafa;
        padding: 16px;
        border-radius: 8px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 700px;
      }

      .nav-menu {
        display: flex;
        flex-direction: column;
        gap: 8px;
      }

      .nav-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 8px 12px;
        border-radius: 20px;
        text-decoration: none;
        color: #121217;
        font-size: 14px;
        font-weight: 500;
        line-height: 1.5;
        transition: background-color 0.15s ease;
      }

      .nav-item:hover {
        background-color: #ebedf2;
      }

      .nav-item.active {
        background-color: #ebedf2;
      }

      .nav-item svg {
        width: 24px;
        height: 24px;
        fill: #121217;
      }

      /* Main Content */
      .main-content {
        flex: 1;
        max-width: 960px;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
      }

      .content-header {
        padding: 16px;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 12px;
        width: 100%;
      }

      .page-title {
        font-size: 32px;
        font-weight: 700;
        color: #121217;
        line-height: 1.25;
        text-align: right;
        min-width: 288px;
      }

      /* Section */
      .section {
        width: 100%;
        margin-bottom: 8px;
      }

      .section-header {
        padding: 16px 16px 8px 16px;
        display: flex;
        justify-content: flex-end;
        align-items: flex-start;
      }

      .section-title {
        font-size: 18px;
        font-weight: 700;
        color: #121217;
        line-height: 1.28;
      }

      .section-content {
        padding: 16px;
      }

      /* Logo Upload Section */
      .logo-upload {
        display: flex;
        padding: 56px 24px;
        flex-direction: column;
        align-items: center;
        gap: 24px;
        border-radius: 12px;
        border: 2px dashed #d6d9e3;
        cursor: pointer;
        transition: border-color 0.15s ease;
      }

      .logo-upload:hover {
        border-color: #3d99f5;
      }

      .logo-upload-content {
        display: flex;
        max-width: 480px;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        text-align: center;
      }

      .logo-upload-title {
        font-size: 18px;
        font-weight: 700;
        color: #121217;
        line-height: 1.28;
      }

      .logo-upload-subtitle {
        font-size: 14px;
        font-weight: 400;
        color: #121217;
        line-height: 1.5;
      }

      /* Input Fields */
      .input-container {
        max-width: 480px;
        padding: 12px 16px;
        display: flex;
        justify-content: flex-end;
        align-items: flex-end;
        align-content: flex-end;
        gap: 16px;
        flex-wrap: wrap;
      }

      .input-field {
        display: flex;
        min-width: 160px;
        flex-direction: column;
        align-items: flex-start;
        flex: 1;
      }

      .input {
        display: flex;
        height: 56px;
        padding: 15px;
        justify-content: flex-end;
        align-items: center;
        width: 100%;
        border-radius: 12px;
        border: 1px solid #d6d9e3;
        background: #fafafa;
        font-family: inherit;
        font-size: 16px;
        font-weight: 400;
        line-height: 1.5;
        color: #4f5053;
        text-align: right;
      }

      .input:focus {
        outline: none;
        border-color: #3d99f5;
        background: #fff;
      }

      .input.filled {
        color: #455a93;
      }

      .input.privacy {
        color: #5c698a;
      }

      /* Toggle Section */
      .toggle-section {
        height: 56px;
        min-height: 56px;
        padding: 0 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #fafafa;
      }

      .toggle-container {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
      }

      .toggle-switch {
        width: 51px;
        height: 31px;
        padding: 2px;
        border-radius: 15.5px;
        background: #ebedf2;
        display: flex;
        align-items: center;
        cursor: pointer;
        transition: background-color 0.15s ease;
      }

      .toggle-switch.active {
        background: #3d99f5;
      }

      .toggle-knob {
        width: 27px;
        height: 27px;
        border-radius: 13.5px;
        background: #fff;
        box-shadow: 0px 3px 8px 0px rgba(0, 0, 0, 0.15);
        transition: transform 0.15s ease;
      }

      .toggle-switch.active .toggle-knob {
        transform: translateX(20px);
      }

      .toggle-label {
        font-size: 16px;
        font-weight: 400;
        color: #121217;
        line-height: 1.5;
        flex: 1;
        text-align: right;
        margin-right: 16px;
      }

      /* Save Button */
      .save-section {
        padding: 12px 16px;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        width: 100%;
      }

      .save-btn {
        height: 40px;
        min-width: 84px;
        max-width: 480px;
        padding: 0 16px;
        background: #3d99f5;
        border: none;
        border-radius: 20px;
        color: #fff;
        font-family: inherit;
        font-size: 14px;
        font-weight: 700;
        line-height: 1.5;
        cursor: pointer;
        transition: background-color 0.15s ease;
      }

      .save-btn:hover {
        background: #2684e0;
      }

      /* Responsive Design */
      @media (max-width: 768px) {
        .header {
          padding: 12px 24px;
        }

        .main-layout {
          flex-direction: column;
        }

        .sidebar {
          width: 100%;
          min-height: auto;
        }

        .sidebar-content {
          min-height: auto;
          flex-direction: row;
          justify-content: flex-start;
          overflow-x: auto;
        }

        .nav-menu {
          flex-direction: row;
          min-width: max-content;
        }

        .page-title {
          font-size: 24px;
          text-align: right;
        }

        .content-header {
          align-items: stretch;
        }

        .input-container {
          flex-direction: column;
          gap: 8px;
        }

        .logo-upload {
          padding: 32px 16px;
        }
      }
    </style>
  </head>
  <body>
    <!-- Header -->
    <header class="header">
      <div class="header-content">
        <div class="logo-section">
          <img
            src="https://cdn.builder.io/api/v1/image/assets/TEMP/5029f4236f65d0d4d941d8086f6901a1afaa86c0?width=82"
            alt="صراحة"
          />
          <h1 class="font-cairo">صراحة</h1>
        </div>
        <div class="header-actions">
          <div class="notification-btn">
            <svg
              width="16"
              height="18"
              viewBox="0 0 16 18"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M15.3281 12.7453C14.8945 11.9984 14.25 9.88516 14.25 7.125C14.25 3.67322 11.4518 0.875 8 0.875C4.54822 0.875 1.75 3.67322 1.75 7.125C1.75 9.88594 1.10469 11.9984 0.671094 12.7453C0.445722 13.1318 0.444082 13.6092 0.666796 13.9973C0.889509 14.3853 1.30261 14.6247 1.75 14.625H4.93828C5.23556 16.0796 6.51529 17.1243 8 17.1243C9.48471 17.1243 10.7644 16.0796 11.0617 14.625H14.25C14.6972 14.6244 15.1101 14.3849 15.3326 13.9969C15.5551 13.609 15.5534 13.1317 15.3281 12.7453ZM8 15.875C7.20562 15.8748 6.49761 15.3739 6.23281 14.625H9.76719C9.50239 15.3739 8.79438 15.8748 8 15.875ZM1.75 13.375C2.35156 12.3406 3 9.94375 3 7.125C3 4.36358 5.23858 2.125 8 2.125C10.7614 2.125 13 4.36358 13 7.125C13 9.94141 13.6469 12.3383 14.25 13.375H1.75Z"
                fill="#0D141C"
              />
            </svg>
          </div>
          <img
            src="https://cdn.builder.io/api/v1/image/assets/TEMP/015fa293e459dfe000ffdda9c07ca06898cad73e?width=80"
            alt="المستخدم"
            class="user-avatar"
          />
        </div>
      </div>
    </header>

    <!-- Main Layout -->
    <div class="main-layout">
      <!-- Sidebar -->
      <aside class="sidebar">
        <div class="sidebar-content">
          <nav class="nav-menu">
            <a href="#" class="nav-item">
              <svg
                width="18"
                height="19"
                viewBox="0 0 18 19"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M17.5153 7.72844L10.0153 0.652188C10.0116 0.648989 10.0082 0.645543 10.005 0.641875C9.43281 0.121501 8.55876 0.121501 7.98656 0.641875L7.97625 0.652188L0.484688 7.72844C0.17573 8.01254 -6.38962e-05 8.41309 0 8.83281V17.5C0 18.3284 0.671573 19 1.5 19H6C6.82843 19 7.5 18.3284 7.5 17.5V13H10.5V17.5C10.5 18.3284 11.1716 19 12 19H16.5C17.3284 19 18 18.3284 18 17.5V8.83281C18.0001 8.41309 17.8243 8.01254 17.5153 7.72844ZM16.5 17.5H12V13C12 12.1716 11.3284 11.5 10.5 11.5H7.5C6.67157 11.5 6 12.1716 6 13V17.5H1.5V8.83281L1.51031 8.82344L9 1.75L16.4906 8.82156L16.5009 8.83094L16.5 17.5Z"
                  fill="#121217"
                />
              </svg>
              <span>الرئيسية</span>
            </a>
            <a href="#" class="nav-item">
              <svg
                width="24"
                height="16"
                viewBox="0 0 24 16"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M10.9922 10.805C13.0561 9.43099 13.9769 6.86767 13.2592 4.49441C12.5414 2.12114 10.3544 0.497718 7.875 0.497718C5.39558 0.497718 3.20857 2.12114 2.49084 4.49441C1.7731 6.86767 2.69393 9.43099 4.75781 10.805C2.93952 11.4752 1.38666 12.7153 0.330938 14.3403C0.179932 14.5647 0.161484 14.8531 0.28266 15.095C0.403836 15.3368 0.645857 15.4947 0.916031 15.5081C1.18621 15.5215 1.44266 15.3884 1.58719 15.1597C2.97076 13.0317 5.33677 11.7479 7.875 11.7479C10.4132 11.7479 12.7792 13.0317 14.1628 15.1597C14.3917 15.4999 14.8514 15.5932 15.1948 15.3692C15.5382 15.1452 15.6381 14.6869 15.4191 14.3403C14.3633 12.7153 12.8105 11.4752 10.9922 10.805ZM3.75 6.125C3.75 3.84683 5.59683 2 7.875 2C10.1532 2 12 3.84683 12 6.125C12 8.40317 10.1532 10.25 7.875 10.25C5.5979 10.2474 3.75258 8.4021 3.75 6.125ZM23.4506 15.3781C23.1037 15.6043 22.6391 15.5066 22.4128 15.1597C21.0308 13.0303 18.6636 11.7466 16.125 11.75C15.7108 11.75 15.375 11.4142 15.375 11C15.375 10.5858 15.7108 10.25 16.125 10.25C17.7863 10.2484 19.2846 9.25041 19.9261 7.71798C20.5677 6.18554 20.2273 4.4178 19.0626 3.23312C17.898 2.04844 16.1363 1.67805 14.5931 2.29344C14.3427 2.40171 14.0531 2.36541 13.8372 2.19864C13.6212 2.03188 13.5128 1.76096 13.5542 1.49125C13.5956 1.22154 13.7802 0.995581 14.0363 0.90125C16.7109 -0.165433 19.7592 0.960007 21.099 3.50883C22.4388 6.05765 21.6374 9.2067 19.2422 10.805C21.0605 11.4752 22.6133 12.7153 23.6691 14.3403C23.8953 14.6872 23.7975 15.1518 23.4506 15.3781Z"
                  fill="#121217"
                />
              </svg>
              <span>المستخدمون</span>
            </a>
            <a href="#" class="nav-item">
              <svg
                width="20"
                height="16"
                viewBox="0 0 20 16"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M19 0.5H1C0.585786 0.5 0.25 0.835786 0.25 1.25V14C0.25 14.8284 0.921573 15.5 1.75 15.5H18.25C19.0784 15.5 19.75 14.8284 19.75 14V1.25C19.75 0.835786 19.4142 0.5 19 0.5ZM10 8.48281L2.92844 2H17.0716L10 8.48281ZM7.25406 8L1.75 13.0447V2.95531L7.25406 8ZM8.36406 9.01719L9.48906 10.0531C9.77592 10.3165 10.2166 10.3165 10.5034 10.0531L11.6284 9.01719L17.0659 14H2.92844L8.36406 9.01719ZM12.7459 8L18.25 2.95437V13.0456L12.7459 8Z"
                  fill="#121217"
                />
              </svg>
              <span>الرسائل</span>
            </a>
            <a href="#" class="nav-item">
              <svg
                width="18"
                height="19"
                viewBox="0 0 18 19"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M0.25875 1.9375C0.0955184 2.07899 0.0012188 2.28399 0 2.5V18.25C0 18.6642 0.335786 19 0.75 19C1.16421 19 1.5 18.6642 1.5 18.25V14.1034C4.01156 12.1197 6.17531 13.1894 8.66719 14.4231C10.2047 15.1834 11.8603 16.0028 13.6359 16.0028C14.9419 16.0028 16.3116 15.5575 17.7441 14.3153C17.9073 14.1738 18.0016 13.9688 18.0028 13.7528V2.5C18.0021 2.20599 17.8297 1.93951 17.5618 1.81838C17.2939 1.69725 16.9799 1.74382 16.7588 1.9375C14.1338 4.20906 11.91 3.10844 9.33281 1.8325C6.66281 0.50875 3.63562 -0.988437 0.25875 1.9375ZM16.5 13.3984C13.9884 15.3822 11.8247 14.3116 9.33281 13.0787C6.98906 11.9209 4.38188 10.6291 1.5 12.2913V2.85531C4.01156 0.871562 6.17531 1.94125 8.66719 3.17406C11.0109 4.33188 13.6191 5.62375 16.5 3.96156V13.3984Z"
                  fill="#121217"
                />
              </svg>
              <span>التقارير</span>
            </a>
            <a href="#" class="nav-item">
              <svg
                width="21"
                height="19"
                viewBox="0 0 21 19"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M20.5 9.25C20.4974 6.76579 18.4842 4.75258 16 4.75H12.2688C11.9959 4.73406 7.24187 4.39937 2.71469 0.6025C2.26836 0.227648 1.64529 0.145289 1.11689 0.391299C0.588491 0.637309 0.250443 1.16714 0.25 1.75V16.75C0.250079 17.333 0.58799 17.8632 1.11646 18.1094C1.64494 18.3557 2.26823 18.2734 2.71469 17.8984C6.25562 14.9284 9.93344 14.0772 11.5 13.8391V16.8128C11.4994 17.3148 11.7499 17.7839 12.1675 18.0625L13.1987 18.7497C13.6032 19.0196 14.1134 19.0768 14.5676 18.903C15.0217 18.7292 15.3635 18.346 15.4844 17.875L16.5878 13.7163C18.8269 13.4183 20.4995 11.5088 20.5 9.25ZM1.75 16.7434V1.75C5.76344 5.11656 9.87156 5.96875 11.5 6.17875V12.3175C9.87344 12.5312 5.76625 13.3816 1.75 16.7434ZM14.0312 17.4934V17.5037L13 16.8166V13.75H15.025L14.0312 17.4934ZM16 12.25H13V6.25H16C17.6569 6.25 19 7.59315 19 9.25C19 10.9069 17.6569 12.25 16 12.25Z"
                  fill="#121217"
                />
              </svg>
              <span>الإعلانات</span>
            </a>
            <a href="#" class="nav-item">
              <svg
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M9 13L15 13"
                  stroke="#33363F"
                  stroke-width="2"
                  stroke-linecap="round"
                />
                <path
                  d="M9 9L13 9"
                  stroke="#33363F"
                  stroke-width="2"
                  stroke-linecap="round"
                />
                <path
                  d="M9 17L13 17"
                  stroke="#33363F"
                  stroke-width="2"
                  stroke-linecap="round"
                />
                <path
                  d="M19 13V15C19 17.8284 19 19.2426 18.1213 20.1213C17.2426 21 15.8284 21 13 21H11C8.17157 21 6.75736 21 5.87868 20.1213C5 19.2426 5 17.8284 5 15V9C5 6.17157 5 4.75736 5.87868 3.87868C6.75736 3 8.17157 3 11 3V3"
                  stroke="#33363F"
                  stroke-width="2"
                />
                <path
                  d="M18 3L18 9"
                  stroke="#33363F"
                  stroke-width="2"
                  stroke-linecap="round"
                />
                <path
                  d="M21 6L15 6"
                  stroke="#33363F"
                  stroke-width="2"
                  stroke-linecap="round"
                />
              </svg>
              <span>المقالات</span>
            </a>
            <a href="#" class="nav-item active">
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
                  d="M18.25 10.2025C18.2537 10.0675 18.2537 9.9325 18.25 9.7975L19.6488 8.05C19.7975 7.86393 19.849 7.61827 19.7875 7.38813C19.5578 6.52633 19.2148 5.6988 18.7675 4.92719C18.6486 4.72249 18.4401 4.58592 18.205 4.55875L15.9813 4.31125C15.8888 4.21375 15.795 4.12 15.7 4.03L15.4375 1.80063C15.4101 1.56531 15.2732 1.35677 15.0681 1.23813C14.2966 0.791171 13.469 0.448795 12.6072 0.22C12.377 0.158514 12.1314 0.210013 11.9453 0.35875L10.2025 1.75C10.0675 1.75 9.9325 1.75 9.7975 1.75L8.05 0.354063C7.86393 0.205326 7.61827 0.153827 7.38813 0.215312C6.52633 0.445025 5.6988 0.788016 4.92719 1.23531C4.72249 1.35417 4.58592 1.56268 4.55875 1.79781L4.31125 4.02531C4.21375 4.11844 4.12 4.21219 4.03 4.30656L1.80063 4.5625C1.56531 4.58988 1.35677 4.72682 1.23813 4.93188C0.791263 5.70359 0.448595 6.5311 0.219063 7.39281C0.157836 7.6231 0.209687 7.86878 0.35875 8.05469L1.75 9.7975C1.75 9.9325 1.75 10.0675 1.75 10.2025L0.354063 11.95C0.205326 12.1361 0.153827 12.3817 0.215312 12.6119C0.445025 13.4737 0.788016 14.3012 1.23531 15.0728C1.35417 15.2775 1.56268 15.4141 1.79781 15.4412L4.02156 15.6887C4.11469 15.7862 4.20844 15.88 4.30281 15.97L4.5625 18.1994C4.58988 18.4347 4.72682 18.6432 4.93188 18.7619C5.70359 19.2087 6.5311 19.5514 7.39281 19.7809C7.6231 19.8422 7.86878 19.7903 8.05469 19.6413L9.7975 18.25C9.9325 18.2537 10.0675 18.2537 10.2025 18.25L11.95 19.6488C12.1361 19.7975 12.3817 19.849 12.6119 19.7875C13.4738 19.5582 14.3014 19.2152 15.0728 18.7675C15.2775 18.6486 15.4141 18.4401 15.4412 18.205L15.6887 15.9813C15.7862 15.8888 15.88 15.795 15.97 15.7L18.1994 15.4375C18.4347 15.4101 18.6432 15.2732 18.7619 15.0681C19.2087 14.2964 19.5514 13.4689 19.7809 12.6072C19.8422 12.3769 19.7903 12.1312 19.6413 11.9453L18.25 10.2025ZM10 13.75C7.92893 13.75 6.25 12.0711 6.25 10C6.25 7.92893 7.92893 6.25 10 6.25C12.0711 6.25 13.75 7.92893 13.75 10C13.75 12.0711 12.0711 13.75 10 13.75Z"
                  fill="#121217"
                />
              </svg>
              <span>الإعدادات</span>
            </a>
          </nav>
        </div>
      </aside>

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
    </div>

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
  </body>
</html>
