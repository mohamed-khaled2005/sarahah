@extends('layouts.app')
@section('title', 'استعادة كلمة المرور')
@section('page-css')
    <link rel="stylesheet" href="{{ url('css/pages/auth/reset_password.css') }}">
@endsection
@section('main')
<main class="reset-password-section">
  <div class="reset-password-container">
    <div class="header">
      <svg class="icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M12 15V17M6 21H18C19.1046 21 20 20.1046 20 19V13C20 11.8954 19.1046 11 18 11H6C4.89543 11 4 11.8954 4 13V19C4 20.1046 4.89543 21 6 21ZM16 11V7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7V11H16Z" 
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
      <h1 class="title">استعادة كلمة المرور</h1>
      <p class="subtitle">أدخل بريدك الإلكتروني لإرسال رابط إعادة التعيين.</p>
    </div>

    <form class="reset-form">
      <div class="form-group">
        <div class="input-wrapper">
          <svg class="input-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" 
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M22 6L12 13L2 6" 
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <input type="email" class="email-input" placeholder="البريد الإلكتروني">
        </div>
      </div>

      <button type="submit" class="submit-button">
        <span class="button-text">إرسال رابط إعادة التعيين</span>
        <svg class="button-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M22 2L11 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M22 2L15 22L11 13L2 9L22 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </button>
    </form>

    <div class="footer">
      <svg class="back-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M19 12H5M12 19l-7-7 7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
      <a href="#" class="back-link">العودة إلى تسجيل الدخول</a>
    </div>
  </div>
</main>
@endsection