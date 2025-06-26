@extends('layouts.app')
@section('title','Sign Up')
@section('page-css')
    <link rel="stylesheet" href="{{ url('css/pages/auth/signup.css') }}">
@endsection

@section('main')
</section>
<main id="section-signup" class="signup-section">
  <div class="signup-container">
    <h1 class="signup-title">إنشاء حساب جديد</h1>
    <form class="signup-form" action="#" method="post">
      <div class="form-group">
        <input type="text" id="username" class="form-input" placeholder="اسم المستخدم">
      </div>
      <div class="form-group">
        <input type="email" id="email" class="form-input" placeholder="البريد الإلكتروني">
      </div>
      <div class="form-group">
        <input type="password" id="password" class="form-input" placeholder="كلمة المرور">
      </div>
      <div class="form-group">
        <input type="password" id="confirm-password" class="form-input" placeholder="تأكيد كلمة المرور">
      </div>
      <button type="submit" class="submit-btn">إنشاء حساب جديد</button>
    </form>
    <p class="login-prompt">
      لديك حساب بالفعل؟ <a href="#">تسجيل الدخول</a>
    </p>
  </div>
</main>
@endsection