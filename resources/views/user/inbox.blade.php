@extends('layouts.user')
@section('title','صراحة - صندوق الوارد')
@section('page-css')
    <link rel="stylesheet" href="{{ url('css/pages/user/inbox.css') }}">
@endsection
@section('main')
      <!-- Main Content -->
     <div class="main-content">
        <div class="content-container">
          <!-- Page Title -->
          <div class="page-title">
            <div>
              <h2 class="title-text">صندوق الوارد</h2>
            </div>
          </div>

          <!-- Search Bar -->
          <div class="search-container">
            <div class="search-bar">
              <div class="search-wrapper">
                <!-- Search Input - Right side for RTL -->
                <div class="search-input-container">
                  <input
                    type="text"
                    class="search-input"
                    placeholder="ابحث في الرسائل"
                    dir="rtl"
                  />
                </div>

                <!-- Search Icon - Left side for RTL -->
                <div class="search-icon-container">
                  <svg
                    class="search-icon"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M19.5306 18.4694L14.8366 13.7762C17.6629 10.383 17.3204 5.36693 14.0591 2.38935C10.7978 -0.588237 5.77134 -0.474001 2.64867 2.64867C-0.474001 5.77134 -0.588237 10.7978 2.38935 14.0591C5.36693 17.3204 10.383 17.6629 13.7762 14.8366L18.4694 19.5306C18.7624 19.8237 19.2376 19.8237 19.5306 19.5306C19.8237 19.2376 19.8237 18.7624 19.5306 18.4694V18.4694ZM1.75 8.5C1.75 4.77208 4.77208 1.75 8.5 1.75C12.2279 1.75 15.25 4.77208 15.25 8.5C15.25 12.2279 12.2279 15.25 8.5 15.25C4.77379 15.2459 1.75413 12.2262 1.75 8.5V8.5Z"
                    />
                  </svg>
                </div>
              </div>
            </div>
          </div>

          <!-- Message List -->
          <div class="message-list">
            <!-- Message 1 -->
            <div class="message-card">
              <div class="message-content">
                <div class="message-title">
                  <span class="message-title-text">رسالة جديدة</span>
                </div>
                <div class="message-text">
                  <span class="message-body"
                    >مرحبا يا سارة، أتمنى أن تكوني بخير وعافية. أتمنى أن تكوني
                    بخير وعافية.</span
                  >
                </div>
                <div class="message-time">
                  <span class="message-time-text">الوقت: 10:30 ص</span>
                </div>
              </div>

              <div class="message-icon">
                <div class="icon-wrapper">
                  <svg
                    class="check-icon"
                    viewBox="0 0 19 14"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M18.5306 1.28062L6.53063 13.2806C6.38995 13.4215 6.19906 13.5006 6 13.5006C5.80094 13.5006 5.61005 13.4215 5.46937 13.2806L0.219375 8.03063C-0.0736812 7.73757 -0.0736812 7.26243 0.219375 6.96937C0.512431 6.67632 0.987569 6.67632 1.28062 6.96937L6 11.6897L17.4694 0.219375C17.7624 -0.073681 18.2376 -0.073681 18.5306 0.219375C18.8237 0.512431 18.8237 0.987569 18.5306 1.28062V1.28062Z"
                    />
                  </svg>
                </div>
              </div>
            </div>

            <!-- Message 2 -->
            <div class="message-card">
              <div class="message-content">
                <div class="message-title">
                  <span class="message-title-text">رسالة جديدة</span>
                </div>
                <div class="message-text">
                  <span class="message-body"
                    >مرحبا يا سارة، أتمنى أن تكوني بخير وعافية. أتمنى أن تكوني
                    بخير وعافية.</span
                  >
                </div>
                <div class="message-time">
                  <span class="message-time-text">الوقت: 11:45 ص</span>
                </div>
              </div>

              <div class="message-icon">
                <div class="icon-wrapper">
                  <svg
                    class="check-icon"
                    viewBox="0 0 19 14"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M18.5306 1.28062L6.53063 13.2806C6.38995 13.4215 6.19906 13.5006 6 13.5006C5.80094 13.5006 5.61005 13.4215 5.46937 13.2806L0.219375 8.03063C-0.0736812 7.73757 -0.0736812 7.26243 0.219375 6.96937C0.512431 6.67632 0.987569 6.67632 1.28062 6.96937L6 11.6897L17.4694 0.219375C17.7624 -0.073681 18.2376 -0.073681 18.5306 0.219375C18.8237 0.512431 18.8237 0.987569 18.5306 1.28062V1.28062Z"
                    />
                  </svg>
                </div>
              </div>
            </div>

            <!-- Message 3 -->
            <div class="message-card">
              <div class="message-content">
                <div class="message-title">
                  <span class="message-title-text">رسالة جديدة</span>
                </div>
                <div class="message-text">
                  <span class="message-body"
                    >مرحبا يا سارة، أتمنى أن تكوني بخير وعافية. أتمنى أن تكوني
                    بخير وعافية.</span
                  >
                </div>
                <div class="message-time">
                  <span class="message-time-text">الوقت: 12:15 ص</span>
                </div>
              </div>

              <div class="message-icon">
                <div class="icon-wrapper">
                  <svg
                    class="check-icon"
                    viewBox="0 0 19 14"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M18.5306 1.28062L6.53063 13.2806C6.38995 13.4215 6.19906 13.5006 6 13.5006C5.80094 13.5006 5.61005 13.4215 5.46937 13.2806L0.219375 8.03063C-0.0736812 7.73757 -0.0736812 7.26243 0.219375 6.96937C0.512431 6.67632 0.987569 6.67632 1.28062 6.96937L6 11.6897L17.4694 0.219375C17.7624 -0.073681 18.2376 -0.073681 18.5306 0.219375C18.8237 0.512431 18.8237 0.987569 18.5306 1.28062V1.28062Z"
                    />
                  </svg>
                </div>
              </div>
            </div>

            <!-- Message 4 -->
            <div class="message-card">
              <div class="message-content">
                <div class="message-title">
                  <span class="message-title-text">رسالة جديدة</span>
                </div>
                <div class="message-text">
                  <span class="message-body"
                    >مرحبا يا سارة، أتمنى أن تكوني بخير وعافية. أتمنى أن تكوني
                    بخير وعافية.</span
                  >
                </div>
                <div class="message-time">
                  <span class="message-time-text">الوقت: 13:30 ص</span>
                </div>
              </div>

              <div class="message-icon">
                <div class="icon-wrapper">
                  <svg
                    class="check-icon"
                    viewBox="0 0 19 14"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M18.5306 1.28062L6.53063 13.2806C6.38995 13.4215 6.19906 13.5006 6 13.5006C5.80094 13.5006 5.61005 13.4215 5.46937 13.2806L0.219375 8.03063C-0.0736812 7.73757 -0.0736812 7.26243 0.219375 6.96937C0.512431 6.67632 0.987569 6.67632 1.28062 6.96937L6 11.6897L17.4694 0.219375C17.7624 -0.073681 18.2376 -0.073681 18.5306 0.219375C18.8237 0.512431 18.8237 0.987569 18.5306 1.28062V1.28062Z"
                    />
                  </svg>
                </div>
              </div>
            </div>

            <!-- Message 5 -->
            <div class="message-card">
              <div class="message-content">
                <div class="message-title">
                  <span class="message-title-text">رسالة جديدة</span>
                </div>
                <div class="message-text">
                  <span class="message-body"
                    >مرحبا يا سارة، أتمنى أن تكوني بخير وعافية. أتمنى أن تكوني
                    بخير وعافية.</span
                  >
                </div>
                <div class="message-time">
                  <span class="message-time-text">الوقت: 14:45 ص</span>
                </div>
              </div>

              <div class="message-icon">
                <div class="icon-wrapper">
                  <svg
                    class="check-icon"
                    viewBox="0 0 19 14"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M18.5306 1.28062L6.53063 13.2806C6.38995 13.4215 6.19906 13.5006 6 13.5006C5.80094 13.5006 5.61005 13.4215 5.46937 13.2806L0.219375 8.03063C-0.0736812 7.73757 -0.0736812 7.26243 0.219375 6.96937C0.512431 6.67632 0.987569 6.67632 1.28062 6.96937L6 11.6897L17.4694 0.219375C17.7624 -0.073681 18.2376 -0.073681 18.5306 0.219375C18.8237 0.512431 18.8237 0.987569 18.5306 1.28062V1.28062Z"
                    />
                  </svg>
                </div>
              </div>
            </div>

            <!-- Message 6 -->
            <div class="message-card">
              <div class="message-content">
                <div class="message-title">
                  <span class="message-title-text">رسالة جديدة</span>
                </div>
                <div class="message-text">
                  <span class="message-body"
                    >مرحبا يا سارة، أتمنى أن تكوني بخير وعافية. أتمنى أن تكوني
                    بخير وعافية.</span
                  >
                </div>
                <div class="message-time">
                  <span class="message-time-text">الوقت: 15:15 ص</span>
                </div>
              </div>

              <div class="message-icon">
                <div class="icon-wrapper">
                  <svg
                    class="check-icon"
                    viewBox="0 0 19 14"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M18.5306 1.28062L6.53063 13.2806C6.38995 13.4215 6.19906 13.5006 6 13.5006C5.80094 13.5006 5.61005 13.4215 5.46937 13.2806L0.219375 8.03063C-0.0736812 7.73757 -0.0736812 7.26243 0.219375 6.96937C0.512431 6.67632 0.987569 6.67632 1.28062 6.96937L6 11.6897L17.4694 0.219375C17.7624 -0.073681 18.2376 -0.073681 18.5306 0.219375C18.8237 0.512431 18.8237 0.987569 18.5306 1.28062V1.28062Z"
                    />
                  </svg>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection