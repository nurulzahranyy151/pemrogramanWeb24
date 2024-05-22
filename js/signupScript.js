document.addEventListener("DOMContentLoaded", function() {
  const form = document.getElementById('form');
  const passwordInput = document.getElementById('password');
  const password2Input = document.getElementById('password2');
  
  form.addEventListener('submit', function(event) {
    let isValid = true;
    
    // Validasi NIK
    const nikInput = document.getElementById('nik');
    if (nikInput.value === '') {
      showError(nikInput, 'NIK harus diisi');
      isValid = false;
    } else if (!/^\d{16}$/.test(nikInput.value)) {
      showError(nikInput, 'NIK harus terdiri dari 16 angka');
      isValid = false;
    } else {
      showSuccess(nikInput);
    }
    
    // Validasi Username
    const namaInput = document.getElementById('nama');
    if (namaInput.value === '') {
      showError(namaInput, 'Username harus diisi');
      isValid = false;
    } else {
      showSuccess(namaInput);
    }
    
    // Validasi Email
    const emailInput = document.getElementById('email');
    if (emailInput.value === '') {
      showError(emailInput, 'Email harus diisi');
      isValid = false;
    } else if (!isValidEmail(emailInput.value)) {
      showError(emailInput, 'Email tidak valid');
      isValid = false;
    } else {
      showSuccess(emailInput);
    }
    
    // Validasi Password
    if (passwordInput.value === '') {
      showError(passwordInput, 'Password harus diisi');
      isValid = false;
    } else if (!isValidPassword(passwordInput.value)) {
      showError(passwordInput, 'Password harus terdiri dari kombinasi huruf besar, kecil, dan angka');
      isValid = false;
    } else {
      showSuccess(passwordInput);
    }
    
    // Validasi Password Validation
    if (password2Input.value === '') {
      showError(password2Input, 'Password Validation harus diisi');
      isValid = false;
    } else if (passwordInput.value !== password2Input.value) {
      showError(password2Input, 'Password tidak cocok');
      isValid = false;
    } else {
      showSuccess(password2Input);
    }
    
    if (!isValid) {
      event.preventDefault();
    }
  });
  
  function showError(input, message) {
    const formControl = input.parentElement;
    const errorDiv = formControl.querySelector('.error');
    errorDiv.textContent = message;
    errorDiv.style.display = 'block';
  }
  
  function showSuccess(input) {
    const formControl = input.parentElement;
    const errorDiv = formControl.querySelector('.error');
    errorDiv.textContent = '';
    errorDiv.style.display = 'none';
  }

  function isValidEmail(email) {
    return /\S+@\S+\.\S+/.test(email);
  }
  
  function isValidPassword(password) {
    return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/.test(password);
  }
});
