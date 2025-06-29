@extends('layouts.app')
@section('title','login')
@section('page-css')
    <link rel="stylesheet" href="{{ url('css/pages/auth/login.css') }}">
@endsection
@section('main')
<main id="section-main" class="login-main">
  <div class="login-container">
    <h1 class="login-title">تسجيل الدخول</h1>
    @if($errors->any())
    @foreach($errors->all() as $error)
    {{$error}}
    @endforeach
    @endif
    <form action="{{route('login_user')}}" method="post" class="login-form">
      @csrf
      @method("post")
      <div class="form-group">
        <input type="text" name="emailorusername" value="{{old('emailorusername')}}" class="form-input" placeholder="البريد الإلكتروني أو اسم المستخدم">
      </div>
      <div class="form-group">
        <input type="password" name="password"class="form-input" value="{{old('password')}}" placeholder="كلمة المرور">
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
      <a href="{{route('reset_password')}}" class="login-link">نسيت كلمة المرور؟</a>
      <a href="{{route('register')}}" class="login-link">ليس لديك حساب؟ أنشئ حسابا جديدا</a>
    </div>
  </div>
</main>
@endsection