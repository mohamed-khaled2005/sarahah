      document.addEventListener('DOMContentLoaded', function() {
  const toggle = document.querySelector('.password-toggle');
  const passwordInput = document.querySelector('input[name="password"]');
  if(toggle && passwordInput) {
    toggle.addEventListener('click', function() {
      const type = passwordInput.type === 'password' ? 'text' : 'password';
      passwordInput.type = type;
    });
  }
});