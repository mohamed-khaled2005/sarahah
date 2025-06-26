@extends('layouts.user')
@section('title','صراحة - تعديل الملف الشخصي')
@section('page-css')
    <link rel="stylesheet" href="{{ url('css/pages/user/profile.css') }}">
@endsection
@section('main')
      <!-- Main Content -->
      <div class="main-content">
        <div class="content-wrapper">
               <!-- Right Section - Profile Form -->
          <div class="form-section">
            <div class="form-container">
              <!-- Title -->
              <div class="form-title">
                <h1>تعديل الملف الشخصي</h1>
              </div>

              <!-- Username Field -->
              <div class="form-field">
                <div class="field-container">
                  <label class="field-label">اسم المستخدم</label>
                  <input type="text" class="field-input" placeholder="" />
                </div>
              </div>

              <!-- Bio Field -->
              <div class="form-field">
                <div class="field-container">
                  <label class="field-label">النبذة التعريفية</label>
                  <textarea class="field-textarea" placeholder=""></textarea>
                </div>
              </div>

              <!-- Profile Link Field -->
              <div class="form-field">
                <div class="field-container">
                  <label class="field-label">رابط الملف الشخصي العام</label>
                  <div class="field-input-group">
                    <input
                      type="text"
                      class="field-input-flex"
                      placeholder=""
                    />
                    <div class="field-input-icon">
                      <svg
                        class="copy-icon"
                        width="18"
                        height="19"
                        viewBox="0 0 18 19"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M17.25 0.5H5.25C4.83579 0.5 4.5 0.835786 4.5 1.25V5H0.75C0.335786 5 0 5.33579 0 5.75V17.75C0 18.1642 0.335786 18.5 0.75 18.5H12.75C13.1642 18.5 13.5 18.1642 13.5 17.75V14H17.25C17.6642 14 18 13.6642 18 13.25V1.25C18 0.835786 17.6642 0.5 17.25 0.5ZM12 17H1.5V6.5H12V17ZM16.5 12.5H13.5V5.75C13.5 5.33579 13.1642 5 12.75 5H6V2H16.5V12.5Z"
                        />
                      </svg>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Status -->
              <div class="status-section">
                <div class="status-text">الحالة: نشط</div>
              </div>

              <!-- Save Button -->
              <div class="save-button-section">
                <button class="save-button">حفظ التغييرات</button>
              </div>
            </div>
          </div>
          <!-- Left Section - Profile Image and Action Buttons -->
          <div class="profile-section">
            <div class="profile-image-container">
              <img
                src="https://cdn.builder.io/api/v1/image/assets/TEMP/23a0be8bfb4729298239b5e7a9b37d9c6e565f82"
                alt="Profile"
                class="profile-image"
              />
            </div>

            <div class="action-buttons">
              <button class="action-button primary">تعديل الملف الشخصي</button>
              <button class="action-button secondary">تغيير الصورة</button>
              <button class="action-button secondary">حذف الحساب</button>
            </div>
          </div>

       
        </div>
      </div>

@endsection