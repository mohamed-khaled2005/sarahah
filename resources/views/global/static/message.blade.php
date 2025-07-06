@extends('layouts.app')
@section('title','صراحة - إرسال رسالة')
@section('page-css')
    <link rel="stylesheet" href="{{ url('css/pages/message-page.css') }}">
@endsection
@section('main')
    <div class="main-content">
      <div class="content-area">
        <div class="content-wrapper">
          <!-- Profile Section -->
          <div class="profile-section">
            <div class="profile-content">
              <div class="profile-info">
                <div class="profile-name">{{ $user->name ?? 'المستخدم' }}</div>
                <div class="profile-subtitle">قم بارسال رسالتك المجهولة</div>
              </div>
              <div class="avatar-container">
                <img
                  class="profile-avatar"
                  src="{{ $user->avatar_url ?? 'https://cdn.builder.io/api/v1/image/assets/TEMP/3c96996ca3c0142be6a28655f2bc050756ff0b8a?width=256' }}"
                  alt="{{ $user->name ?? 'المستخدم' }}"
                />
                <div class="avatar-border"></div>
              </div>
            </div>
          </div>

          <!-- Message Input Section -->
          <form action="{{ route('send.message', ['identifier' => $user->username]) }}" method="post" id="messageForm">
            @csrf
            <div class="message-section">
              <div class="message-input">
                <div class="textarea-wrapper">
                  <textarea
                    class="message-textarea"
                    placeholder="اكتب رسالتك هنا..."
                    id="messageInput"
                    name="message-content"
                    required
                    maxlength="1000"
                  ></textarea>
                  <div class="char-counter"><span id="charCount">0</span>/1000</div>
                </div>
              </div>
            </div>

            <!-- Help Text -->
            <div class="help-text">
              <p>رسالتك ستكون مجهولة الهوية، يمكنك قول ما تريد بكل صدق وشفافية</p>
            </div>

            <!-- Send Button -->
            <div class="send-section">
              <button class="send-button" type="submit" id="submitButton">
                <div class="send-content">
                  <span class="send-text">إرسال الآن</span>
                  <svg class="send-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22 2L11 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M22 2L15 22L11 13L2 9L22 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                  <div class="loading-spinner"></div>
                </div>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
@endsection

@section('page-js')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const textarea = document.getElementById('messageInput');
  const charCount = document.getElementById('charCount');
  const form = document.getElementById('messageForm');
  const submitButton = document.getElementById('submitButton');
  const sendIcon = document.querySelector('.send-icon');
  const loadingSpinner = document.querySelector('.loading-spinner');
  
  // عدّاد الأحرف
  if (textarea && charCount) {
    textarea.addEventListener('input', function() {
      const currentLength = this.value.length;
      charCount.textContent = currentLength;
      
      if (currentLength > 900) {
        charCount.style.color = '#FF4757';
      } else {
        charCount.style.color = 'var(--primary-color)';
      }
    });
  }
  
  // إدارة إرسال النموذج
  if (form) {
    form.addEventListener('submit', async function(e) {
      e.preventDefault();
      
      // التحقق من وجود نص
      if (!textarea.value.trim()) {
        showAlert('error', 'الرجاء كتابة رسالة قبل الإرسال');
        textarea.focus();
        return;
      }
      
      // تغيير حالة الزر أثناء الإرسال
      setButtonState(true);
      
      try {
        const formData = new FormData(form);
        
        const response = await fetch(form.action, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
          },
          body: formData
        });
        
        const data = await response.json();
        
        if (response.ok) {
          showAlert('success', data.message || 'تم إرسال رسالتك بنجاح!');
          form.reset();
          charCount.textContent = '0';
        } else {
          const errorMsg = data.errors ? Object.values(data.errors).join('<br>') : 
                        data.message || 'حدث خطأ أثناء الإرسال، الرجاء المحاولة لاحقاً';
          showAlert('error', errorMsg);
        }
      } catch (error) {
        showAlert('error', 'فشل الاتصال بالخادم، الرجاء التحقق من اتصال الإنترنت');
      } finally {
        setButtonState(false);
      }
    });
  }
  
  // وظيفة لعرض التنبيهات
  function showAlert(type, message) {
    // إزالة أي تنبيهات سابقة
    const oldAlert = document.querySelector('.custom-alert');
    if (oldAlert) oldAlert.remove();
    
    // إنشاء عنصر التنبيه
    const alert = document.createElement('div');
    alert.className = `custom-alert ${type}`;
    alert.innerHTML = `
      <div class="alert-content">
        <span class="alert-message">${message}</span>
        <button class="alert-close">&times;</button>
      </div>
    `;
    
    // إضافة التنبيه إلى الصفحة
    document.body.appendChild(alert);
    
    // إظهار التنبيه بانتقال سلس
    setTimeout(() => alert.classList.add('show'), 10);
    
    // إغلاق التنبيه عند النقر على الزر
    const closeBtn = alert.querySelector('.alert-close');
    closeBtn.addEventListener('click', () => {
      alert.classList.remove('show');
      setTimeout(() => alert.remove(), 300);
    });
    
    // إغلاق التنبيه تلقائياً بعد 5 ثواني
    setTimeout(() => {
      if (alert.classList.contains('show')) {
        alert.classList.remove('show');
        setTimeout(() => alert.remove(), 300);
      }
    }, 5000);
  }
  
  // وظيفة لتغيير حالة الزر
  function setButtonState(isLoading) {
    if (!submitButton) return;
    
    if (isLoading) {
      submitButton.disabled = true;
      submitButton.querySelector('.send-text').textContent = 'جاري الإرسال...';
      sendIcon.style.display = 'none';
      loadingSpinner.style.display = 'block';
      submitButton.style.opacity = '0.7';
      submitButton.style.cursor = 'not-allowed';
    } else {
      submitButton.disabled = false;
      submitButton.querySelector('.send-text').textContent = 'إرسال الآن';
      sendIcon.style.display = 'block';
      loadingSpinner.style.display = 'none';
      submitButton.style.opacity = '1';
      submitButton.style.cursor = 'pointer';
    }
  }
});
</script>
@endsection