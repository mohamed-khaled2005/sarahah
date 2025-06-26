@extends('layouts.app')
@section('title','login')
@section('page-css')
    <link rel="stylesheet" href="{{ url('css/pages/login_pages/login.css') }}">
@endsection
@section('main')
<main id="section-main" class="login-main">
  <div class="login-container">
    <h1 class="login-title">تسجيل الدخول</h1>
    <form class="login-form">
      <div class="form-group">
        <input type="text" class="form-input" placeholder="البريد الإلكتروني أو اسم المستخدم">
      </div>
      <div class="form-group">
        <input type="password" class="form-input" placeholder="كلمة المرور">
      </div>
      <div class="form-options">
        <div class="remember-me">
          <input type="checkbox" id="remember-me" class="checkbox-input">
          <label for="remember-me" class="checkbox-label">تذكرني</label>
        </div>
      </div>
      <button type="submit" class="btn-submit">تسجيل الدخول</button>
    </form>
    <div class="login-links">
      <a href="#" class="login-link">نسيت كلمة المرور؟</a>
      <a href="#" class="login-link">ليس لديك حساب؟ أنشئ حسابا جديدا</a>
    </div>
  </div>
</main>
@endsection