document.addEventListener('DOMContentLoaded', function() {
  // تبديل إظهار/إخفاء كلمة المرور
  const togglePasswords = document.querySelectorAll('.toggle-password');
  
  togglePasswords.forEach(toggle => {
    toggle.addEventListener('click', function() {
      const input = this.closest('.password-wrapper').querySelector('input');
      const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
      input.setAttribute('type', type);
      this.querySelector('svg').style.fill = type === 'password' ? '' : 'var(--color-primary)';
    });
  });
  
  // تحقق من قوة كلمة المرور
  const passwordInput = document.getElementById('password');
  const strengthBar = document.querySelector('.strength-bar');
  const strengthText = document.querySelector('.strength-text span');
  
  if (passwordInput && strengthBar && strengthText) {
    passwordInput.addEventListener('input', function() {
      const password = this.value;
      const strength = calculatePasswordStrength(password);
      
      strengthBar.style.width = strength.percentage + '%';
      strengthBar.style.backgroundColor = strength.color;
      strengthText.textContent = strength.text;
      strengthText.style.color = strength.color;
    });
  }
  
  function calculatePasswordStrength(password) {
    let strength = 0;
    
    // طول كلمة المرور
    if (password.length > 0) strength += 10;
    if (password.length >= 8) strength += 20;
    if (password.length >= 12) strength += 20;
    
    // أحرف متنوعة
    if (/[A-Z]/.test(password)) strength += 10;
    if (/[a-z]/.test(password)) strength += 10;
    if (/[0-9]/.test(password)) strength += 10;
    if (/[^A-Za-z0-9]/.test(password)) strength += 20;
    
    // تحديد مستوى القوة
    if (strength < 30) {
      return { percentage: 25, color: 'var(--color-error)', text: 'ضعيفة' };
    } else if (strength < 70) {
      return { percentage: 50, color: 'var(--color-warning)', text: 'متوسطة' };
    } else if (strength < 100) {
      return { percentage: 75, color: '#2ecc71', text: 'قوية' };
    } else {
      return { percentage: 100, color: 'var(--color-success)', text: 'قوية جداً' };
    }
  }
  
  // إدارة إرسال النموذج
  const form = document.querySelector('.signup-form');
  const submitButton = document.querySelector('.submit-btn');
  
  if (form && submitButton) {
    form.addEventListener('submit', function(e) {
      // يمكنك إضافة التحقق الإضافي هنا
      
      // عرض حالة التحميل
      submitButton.classList.add('loading');
      submitButton.disabled = true;
    });
  }
  
  // إضافة تأثيرات لحقول الإدخال
  const inputs = document.querySelectorAll('.form-input');
  inputs.forEach(input => {
    input.addEventListener('focus', function() {
      const icon = this.parentElement.querySelector('.input-icon svg') || 
                   this.closest('.password-wrapper').previousElementSibling.querySelector('.input-icon svg');
      if (icon) icon.style.fill = 'var(--color-primary)';
    });
    
    input.addEventListener('blur', function() {
      const icon = this.parentElement.querySelector('.input-icon svg') || 
                   this.closest('.password-wrapper').previousElementSibling.querySelector('.input-icon svg');
      if (icon) icon.style.fill = 'var(--color-text-light)';
    });
  });
});