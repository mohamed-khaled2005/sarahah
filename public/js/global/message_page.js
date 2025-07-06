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