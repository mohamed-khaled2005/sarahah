@extends('layout')
@section('title','Reset Password')
@section('page-css')
    <link rel="stylesheet" href="{{ url('css/pages/login_pages/reset_password.css') }}">
@endsection
@section('main')
<main id="section-main" class="main-content reset-password-section">
  <div class="reset-password-container">
    <h1>استعادة كلمة المرور</h1>
    <p class="subtitle">أدخل بريدك الإلكتروني لإرسال رابط إعادة التعيين.</p>
    <form class="reset-form">
      <input type="email" class="email-input" placeholder="البريد الإلكتروني">
      <button type="submit" class="submit-button">إرسال رابط إعادة التعيين</button>
    </form>
    <a href="#" class="back-link">العودة إلى تسجيل الدخول</a>
  </div>
</main>
@endsection