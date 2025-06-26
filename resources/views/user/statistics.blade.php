
@extends('layouts.user')
@section('title','صراحة - الإحصائيات')
@section('page-css')
    <link rel="stylesheet" href="{{ url('css/pages/user/statistics.css') }}">
@endsection
@section('main')
      <!-- Main Content -->
      <main class="main-content">
        <div class="container-content">
          <!-- Page Title -->
          <div class="page-title">
            <h2>الإحصائيات</h2>
          </div>

          <!-- Statistics Cards -->
          <div class="stats-grid">
            <div class="stat-card">
              <div class="stat-content">
                <div class="stat-label">عدد الرسائل الكلي</div>
                <div class="stat-value">1,234</div>
              </div>
            </div>

            <div class="stat-card">
              <div class="stat-content">
                <div class="stat-label">رسائل اليوم</div>
                <div class="stat-value">56</div>
              </div>
            </div>

            <div class="stat-card">
              <div class="stat-content">
                <div class="stat-label">عدد الرسائل المميزة</div>
                <div class="stat-value">78</div>
              </div>
            </div>

            <div class="stat-card">
              <div class="stat-content">
                <div class="stat-label">عدد المشاركات</div>
                <div class="stat-value">90</div>
              </div>
            </div>
          </div>

          <!-- Chart Section -->
          <div class="chart-section">
            <div class="chart-container">
              <!-- Chart Header -->
              <div class="chart-header">
                <div class="chart-title">الرسائل عبر الوقت</div>
              </div>

              <div class="chart-header">
                <div class="chart-value">1,234</div>
              </div>

              <div class="chart-meta">
                <div class="chart-period">الشهر الحالي</div>
                <div class="chart-growth">+12%</div>
              </div>

              <!-- Chart -->
              <div class="chart-area">
                <svg
                  class="chart-svg"
                  viewBox="0 0 928 148"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <defs>
                    <linearGradient
                      id="chartGradient"
                      x1="0"
                      y1="0"
                      x2="0"
                      y2="148"
                      gradientUnits="userSpaceOnUse"
                    >
                      <stop stop-color="#2E2B36" />
                      <stop
                        offset="0.5"
                        stop-color="#2E2B36"
                        stop-opacity="0"
                      />
                    </linearGradient>
                    <clipPath id="chartClip">
                      <rect width="928" height="148" fill="white" />
                    </clipPath>
                  </defs>
                  <g clip-path="url(#chartClip)">
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M5.82427 211.615C41.0685 211.615 41.0685 40.7699 76.3129 40.7699C111.557 40.7699 111.557 79.5983 146.801 79.5983C182.046 79.5983 182.046 180.552 217.29 180.552C252.534 180.552 252.534 64.0669 287.779 64.0669C323.024 64.0669 323.024 196.084 358.266 196.084C393.511 196.084 393.511 118.427 428.755 118.427C464 118.427 464 87.364 499.245 87.364C534.489 87.364 534.489 234.912 569.734 234.912C604.976 234.912 604.976 289.272 640.221 289.272C675.466 289.272 675.466 1.94142 710.71 1.94142C745.955 1.94142 745.955 157.255 781.199 157.255C816.442 157.255 816.442 250.444 851.687 250.444C886.931 250.444 886.931 48.5356 922.176 48.5356V289.272H640.221H5.82427V211.615Z"
                      fill="url(#chartGradient)"
                    />
                    <path
                      d="M5.82427 211.615C41.0685 211.615 41.0685 40.7699 76.3129 40.7699C111.557 40.7699 111.557 79.5983 146.801 79.5983C182.046 79.5983 182.046 180.552 217.29 180.552C252.534 180.552 252.534 64.0669 287.779 64.0669C323.024 64.0669 323.024 196.084 358.266 196.084C393.511 196.084 393.511 118.427 428.755 118.427C464 118.427 464 87.364 499.245 87.364C534.489 87.364 534.489 234.912 569.734 234.912C604.976 234.912 604.976 289.272 640.221 289.272C675.466 289.272 675.466 1.94142 710.71 1.94142C745.955 1.94142 745.955 157.255 781.199 157.255C816.442 157.255 816.442 250.444 851.687 250.444C886.931 250.444 886.931 48.5356 922.176 48.5356"
                      stroke="#A8A3B3"
                      stroke-width="3"
                    />
                  </g>
                </svg>

                <!-- Chart Labels -->
                <div class="chart-labels">
                  <div class="chart-label">أبريل</div>
                  <div class="chart-label">مايو</div>
                  <div class="chart-label">يونيو</div>
                  <div class="chart-label">يوليو</div>
                  <div class="chart-label">أغسطس</div>
                  <div class="chart-label">سبتمبر</div>
                  <div class="chart-label">أكتوبر</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
@endsection

    