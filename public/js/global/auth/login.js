document.addEventListener('DOMContentLoaded', function() {
  // تبديل إظهار/إخفاء كلمة المرور
  const togglePassword = document.querySelector('.toggle-password');
  const passwordInput = document.getElementById('password');
  
  if (togglePassword && passwordInput) {
    togglePassword.addEventListener('click', function() {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      this.querySelector('svg').style.fill = type === 'password' ? '' : 'var(--color-primary)';
    });
  }
  
  // إدارة إرسال النموذج
  const form = document.querySelector('.login-form');
  const submitButton = document.querySelector('.btn-submit');
  
  if (form && submitButton) {
    form.addEventListener('submit', function(e) {
      // يمكنك إضافة التحقق الإضافي هنا إذا لزم الأمر
      
      // عرض حالة التحميل
      submitButton.classList.add('loading');
      submitButton.disabled = true;
    });
  }
  
  // إضافة تأثيرات لحقول الإدخال
  const inputs = document.querySelectorAll('.form-input');
  inputs.forEach(input => {
    input.addEventListener('focus', function() {
      this.parentElement.querySelector('.input-icon svg').style.fill = 'var(--color-primary)';
    });
    
    input.addEventListener('blur', function() {
      this.parentElement.querySelector('.input-icon svg').style.fill = 'var(--color-text-light)';
    });
  });
});