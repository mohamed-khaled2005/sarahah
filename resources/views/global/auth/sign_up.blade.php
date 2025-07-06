@extends('layouts.app')
@section('title', 'إنشاء حساب جديد')
@section('page-css')
    <link rel="stylesheet" href="{{ url('css/pages/auth/signup.css') }}">
@endsection

@section('main')
<main class="signup-section">
  <div class="signup-container">
    <div class="signup-header">
      <h1 class="signup-title">إنشاء حساب جديد</h1>
      <p class="signup-subtitle">انضم إلينا وابدأ رحلتك</p>
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

    <form class="signup-form" action="{{route('save-user')}}" method="post">
      @csrf
      
      <div class="form-group">
        <label for="name" class="form-label">الاسم الكامل</label>
        <input type="text" name="name" id="name" value="{{old('name')}}" class="form-input" 
               placeholder="ادخل اسمك الكامل" required>
        <div class="input-icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
          </svg>
        </div>
        @error('name')
          <p class="error-message">{{$message}}</p>
        @enderror
      </div>

      <div class="form-group">
        <label for="username" class="form-label">اسم المستخدم</label>
        <input type="text" name="username" value="{{old('username')}}" id="username" 
               class="form-input" placeholder="ادخل اسم المستخدم" required>
        <div class="input-icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
          </svg>
        </div>
        @error('username')
          <p class="error-message">{{$message}}</p>
        @enderror
      </div>

      <div class="form-group">
        <label for="email" class="form-label">البريد الإلكتروني</label>
        <input type="email" id="email" name="email" value="{{old('email')}}" 
               class="form-input" placeholder="ادخل البريد الإلكتروني" required>
        <div class="input-icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
          </svg>
        </div>
        @error('email')
          <p class="error-message">{{$message}}</p>
        @enderror
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
        @error('password')
          <p class="error-message">{{$message}}</p>
        @enderror
      </div>

      <div class="form-group">
        <label for="confirm-password" class="form-label">تأكيد كلمة المرور</label>
        <div class="password-wrapper">
          <input type="password" id="confirm-password" name="password_confirmation" 
                 class="form-input" placeholder="أعد إدخال كلمة المرور" required>
          <button type="button" class="toggle-password" aria-label="إظهار/إخفاء كلمة المرور">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12 4C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 12.5c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
            </svg>
          </button>
        </div>
      </div>

      <div class="password-strength">
        <div class="strength-meter">
          <div class="strength-bar"></div>
        </div>
        <div class="strength-text">قوة كلمة المرور: <span>ضعيفة</span></div>
      </div>

      <button type="submit" class="submit-btn">
        <span class="btn-text">إنشاء حساب جديد</span>
        <div class="loading-spinner" style="display: none;"></div>
      </button>
    </form>

    <div class="login-prompt">
      لديك حساب بالفعل؟ <a href="{{route('login')}}" class="login-link">تسجيل الدخول</a>
    </div>
  </div>
</main>

  <script src="{{url('js/global/auth/sign_up.js')}}">
    </script>
@endsection