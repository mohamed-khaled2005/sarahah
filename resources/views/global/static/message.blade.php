@extends('layouts.app')
@section('title','صراحة - إرسال رسالة')

@section('page-css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ url('css/pages/message-page.css') }}">
<style>
.custom-alert {
  position: fixed;
  top: 20px;
  right: 20px;
  z-index: 9999;
  background: #333;
  color: #fff;
  padding: 12px 20px;
  border-radius: 6px;
  font-size: 14px;
  opacity: 0;
  transform: translateY(-10px);
  transition: all 0.4s ease;
}
.custom-alert.show { opacity: 1; transform: translateY(0); }
.custom-alert.success { background-color: #28a745; }
.custom-alert.error { background-color: #dc3545; }
.custom-alert .alert-close {
  background: none;
  border: none;
  color: #fff;
  font-size: 18px;
  margin-left: 8px;
  cursor: pointer;
}
.loading-spinner {
  display: none;
  animation: spin 1s linear infinite;
}
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
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
<script>
document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('messageForm');
  const textarea = document.getElementById('messageInput');
  const charCount = document.getElementById('charCount');
  const submitButton = document.getElementById('submitButton');
  const sendText = submitButton.querySelector('.send-text');
  const sendIcon = submitButton.querySelector('.send-icon');
  const loadingSpinner = submitButton.querySelector('.loading-spinner');

  // تحديث عداد الأحرف
  textarea.addEventListener('input', () => {
    const len = textarea.value.length;
    charCount.textContent = len;
    charCount.style.color = len > 900 ? '#FF4757' : '';
  });

  // إرسال النموذج
  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    e.stopImmediatePropagation();
    
    if (!textarea.value.trim()) {
      showAlert('error', 'الرجاء كتابة رسالة قبل الإرسال');
      textarea.focus();
      return;
    }
    
    setButtonState(true);
    
    try {
      const response = await fetch(form.action, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json',
          'Content-Type': 'application/x-www-form-urlencoded',
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: new URLSearchParams(new FormData(form))
      });
      
      const data = await response.json();
      
      if (response.ok && data.success) {
        showAlert('success', data.message);
        if (data.reset_form) {
          form.reset();
          charCount.textContent = '0';
        }
      } else {
        showAlert('error', data.message || 'حدث خطأ أثناء الإرسال');
      }
    } catch (error) {
      console.error('Error:', error);
      showAlert('error', 'فشل الاتصال بالخادم');
    } finally {
      setButtonState(false);
    }
  });

  // تغيير حالة زر الإرسال
  function setButtonState(loading) {
    submitButton.disabled = loading;
    sendText.textContent = loading ? 'جاري الإرسال...' : 'إرسال الآن';
    sendIcon.style.display = loading ? 'none' : 'block';
    loadingSpinner.style.display = loading ? 'block' : 'none';
  }

  // عرض التنبيهات
  function showAlert(type, message) {
    // إزالة أي تنبيهات سابقة
    const oldAlerts = document.querySelectorAll('.custom-alert');
    oldAlerts.forEach(alert => alert.remove());
    
    const alert = document.createElement('div');
    alert.className = `custom-alert ${type}`;
    alert.innerHTML = `
      ${message}
      <button class="alert-close" aria-label="إغلاق">&times;</button>
    `;
    
    document.body.appendChild(alert);
    setTimeout(() => alert.classList.add('show'), 10);
    
    // إغلاق التنبيه عند النقر على الزر
    alert.querySelector('.alert-close').addEventListener('click', () => {
      alert.classList.remove('show');
      setTimeout(() => alert.remove(), 300);
    });
    
    // إزالة التنبيه تلقائياً بعد 5 ثواني
    setTimeout(() => {
      alert.classList.remove('show');
      setTimeout(() => alert.remove(), 300);
    }, 5000);
  }
});
</script>
@endsection