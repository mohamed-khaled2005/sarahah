@extends('layouts.app')
@section('title','صراحة - إرسال رسالة')

@section('page-css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ url('css/pages/message-page.css') }}">
@endsection

@section('main')
<div class="main-content">
  <div class="content-area">
    <div class="content-wrapper">
      <div class="profile-section">
        <div class="profile-content">
          <div class="profile-info">
            <div class="profile-name">{{ $user->name ?? 'المستخدم' }}</div>
            <div class="profile-subtitle">قم بارسال رسالتك المجهولة</div>
          </div>
          <div class="avatar-container">
            <img class="profile-avatar"
              src="{{ !empty($user->avatar) ? url('avatars/' . $user->avatar) : url('/images/profile.png') }}"
              alt="{{ $user->name ?? 'المستخدم' }}">
            <div class="avatar-border"></div>
          </div>
        </div>
      </div>

      <form action="{{ route('send.message', ['identifier' => $user->username]) }}" method="post" id="messageForm">
        @csrf
        <div class="message-section">
          <div class="textarea-wrapper">
            <textarea class="message-textarea" placeholder="اكتب رسالتك هنا..."
              id="messageInput" name="message-content" required maxlength="1000"></textarea>
            <div class="char-counter"><span id="charCount">0</span>/1000</div>
          </div>
        </div>
        <div class="send-section">
          <button class="send-button" type="submit" id="submitButton">
            <span class="send-text">إرسال الآن</span>
            <svg class="send-icon" viewBox="0 0 24 24" fill="none">
              <path d="M22 2L11 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M22 2L15 22L11 13L2 9L22 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <div class="loading-spinner">
              <svg viewBox="0 0 50 50" width="20" height="20">
                <circle cx="25" cy="25" r="20" fill="none" stroke="currentColor" stroke-width="4"></circle>
              </svg>
            </div>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="{{url('js/global/message_page.js')}}">
</script>
@endsection