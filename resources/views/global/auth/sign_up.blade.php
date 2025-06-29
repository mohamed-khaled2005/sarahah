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
    <form class="signup-form" action="{{route('save-user')}}" method="post">
      @csrf
      @method("post")
      <div class="form-group">
        <input type="text" name="name" id="name" value="{{old('name')}}" class="form-input" placeholder="الأسم كامل">
        @error('name')
        <p>{{$message}}</p>
        @enderror
      </div>
      <div class="form-group">
        <input type="text" name="username" value="{{old('username')}}" id="username" class="form-input" placeholder="اسم المستخدم">
         @error('username')
        <p>{{$message}}</p>
        @enderror
      </div>
      <div class="form-group">
       <input type="email" id="email" name="email" value="{{old('email')}}" class="form-input" placeholder="البريد الإلكتروني">
         @error('email')
        <p>{{$message}}</p>
        @enderror
      </div>
      <div class="form-group">
        <input type="password" id="password" name="password" class="form-input" placeholder="كلمة المرور">
         @error('password')
        <p>{{$message}}</p>
        @enderror
      </div>
      <div class="form-group">
        <input type="password" id="confirm-password" name="password_confirmation" class="form-input" placeholder="تأكيد كلمة المرور">
      </div>
      <button type="submit" class="submit-btn">إنشاء حساب جديد</button>
    </form>
    <p class="login-prompt">
      لديك حساب بالفعل؟ <a href="{{route('login')}}">تسجيل الدخول</a>
    </p>
  </div>
</main>
@endsection