@extends('layouts.app')
@section('title', 'تسجيل الدخول')
@section('page-css')
    <link rel="stylesheet" href="{{ url('css/pages/auth/login.css') }}">
@endsection
@section('main')
<main class="login-main">
  <div class="login-container">
    <div class="login-header">
      <h1 class="login-title">تسجيل الدخول</h1>
      <p class="login-subtitle">مرحباً بعودتك! الرجاء إدخال بياناتك للدخول</p>
    </div>

    @if($errors->any())
      <div class="alert alert-error">
        <div class="alert-icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
          </svg>
        </div>
        <div class="alert-content">
          @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
          @endforeach
        </div>
      </div>
    @endif

    @if(session('success'))
      <div class="alert alert-success">
        <div class="alert-icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
          </svg>
        </div>
        <div class="alert-content">
          <p>{{ session('success') }}</p>
        </div>
      </div>
    @endif

    <form action="{{ route('login_user') }}" method="post" class="login-form">
      @csrf
      <div class="form-group">
        <label for="emailorusername" class="form-label">البريد الإلكتروني أو اسم المستخدم</label>
        <input type="text" id="emailorusername" name="emailorusername" value="{{ old('emailorusername') }}" 
               class="form-input" placeholder="ادخل البريد الإلكتروني أو اسم المستخدم" required>
 
      </div>

      <div class="form-group">
        <label for="password" class="form-label">كلمة المرور</label>
        <div class="password-wrapper">
          <input type="password" id="password" name="password" class="form-input" 
                 placeholder="ادخل كلمة المرور" required>
          <button type="button" class="toggle-password" aria-label="إظهار/إخفاء كلمة المرور">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12 4C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 12.5c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
            </svg>
          </button>
        </div>
      </div>

      <div class="form-options">
        <div class="remember-me">
          <input type="checkbox" id="remember-me" name="remember" class="checkbox-input">
          <label for="remember-me" class="checkbox-label">تذكرني</label>
        </div>
        <a href="{{ route('reset_password') }}" class="forgot-password">نسيت كلمة المرور؟</a>
      </div>

      <button type="submit" class="btn-submit">
        <span class="btn-text">تسجيل الدخول</span>
        <div class="loading-spinner" style="display: none;"></div>
      </button>
    </form>

    <div class="login-footer">
      <p>ليس لديك حساب؟ <a href="{{ route('register') }}" class="register-link">أنشئ حساباً جديداً</a></p>
    </div>
  </div>
</main>
  <script src="{{url('js/global/auth/login.js')}}">
    </script>
@endsection