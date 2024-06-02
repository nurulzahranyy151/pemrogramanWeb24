document.addEventListener("DOMContentLoaded", function() {
  const form = document.getElementById('form');
  const passwordInput = document.getElementById('password');
  const password2Input = document.getElementById('password2');
  
  form.addEventListener('submit', function(event) {
    let isValid = true;

    function validateNIK(nik) {
      var validKodeWilayah = [
         "1101", "1102", "1103", "1104", "1105", "1106", "1107", "1108", "1109", "1110", "1111", "1112", "1113", "1114", "1115", "1116", "1117", "1118", "1171", "1172", "1173", "1174", "1175", "1201", "1202", "1203", "1204", "1205", "1206", "1207", "1208", "1209", "1210", "1211", "1212", "1213", "1214", "1215", "1216", "1217", "1218", "1219", "1220", "1221", "1222", "1223", "1224", "1225", "1271", "1272", "1273", "1274", "1275", "1276", "1277", "1278", "1301", "1302", "1303", "1304", "1305", "1306", "1307", "1308", "1309", "1310", "1311", "1312", "1371", "1372", "1373", "1374", "1375", "1376", "1377", "1401", "1402", "1403", "1404", "1405", "1406", "1407", "1408", "1409", "1410", "1471", "1472", "2101", "2102", "2103", "2104", "2105", "2171", "2172", "3101", "3171", "3172", "3173", "3174", "3175", "3601", "3602", "3603", "3604", "3671", "3672", "3673", "3674", "3201", "3202", "3203", "3204", "3205", "3206", "3207", "3208", "3209", "3210", "3211", "3212", "3213", "3214", "3215", "3216", "3217", "3218", "3271", "3272", "3273", "3274", "3275", "3276", "3277", "3278", "3279", "3301", "3302", "3303", "3304", "3305", "3306", "3307", "3308", "3315", "3316", "3317", "3318", "3319", "3320", "3321", "3322", "3323", "3324", "3325", "3326", "3327", "3328", "3329", "3371", "3372", "3373", "3374", "3375", "3376", "5101", "5102", "5103", "5104", "5105", "5106", "5107", "5108", "5171", "6101", "6102", "6103", "6104", "6105", "6106", "6107", "6108", "6109", "6110", "6111", "6112", "6171", "6172", "6201", "6202", "6203", "6204", "6205", "6206", "6207", "6208", "6209", "6210", "6211", "6212", "6213", "6271", "6301", "6302", "6303", "6304", "6305", "6306", "6307", "6308", "6309", "6310", "6311", "6371", "6372", "7401", "7402", "7403", "7404", "7405", "7406", "7407", "7408", "7409", "7410", "7411", "7412", "7413", "7414", "7415", "7471", "7472", "7501", "7502", "7503", "7504", "7505", "7571", "7601", "7602", "7603", "7604", "7605", "7606", "8101", "8102", "8103", "8104", "8105", "8106", "8107", "8108", "8109", "8171", "8172", "8201", "8202", "8203", "8204", "8205", "8206", "8207", "8208", "8271", "9101", "9102", "9103", "9104", "9105", "9106", "9107", "9108", "9109", "9110", "9111", "9112", "9113", "9114", "9115", "9116", "9117", "9118", "9119", "9120", "9121", "9122", "9123", "9124", "9125", "9126", "9127", "9128", "9171", "9201", "9202", "9203", "9204", "9205", "9206", "5201", "5202", "5203", "5204", "5205", "5206", "5207", "5208", "5271", "5272"
      ];
      var kodeWilayah = nik.substr(0, 4);
      if (!validKodeWilayah.includes(kodeWilayah)) {
        return false;
      }
      const tanggalLahir = nik.substr(6, 2);
      const bulanLahir = nik.substr(8, 2);
      const tahunLahir = nik.substr(10, 2);

      let day = parseInt(tanggalLahir, 10);
      const month = parseInt(bulanLahir, 10);
      const year = parseInt(tahunLahir, 10);

      if (day > 40) {
        day -= 40;
      }

      if (month < 1 || month > 12) {
        return false;
      }

      const maxDays = [31, (year % 4 === 0 && (year % 100 !== 0 || year % 400 === 0)) ? 29 : 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
      if (day < 1 || day > maxDays[month - 1]) {
        return false;
      }
    return { valid: true, tanggalLahir: tanggalLahir, bulanLahir: bulanLahir, tahunLahir: tahunLahir };
  }

    const nikInput = document.getElementById('nik');
    if (nikInput.value === '') {
      showError(nikInput, 'NIK harus diisi');
      isValid = false;
    } else if (!/^\d{16}$/.test(nikInput.value)) {
      showError(nikInput, 'NIK harus terdiri dari 16 angka');
      isValid = false;
    } else {
      const validationResponse = validateNIK(nikInput.value);
      if (!validationResponse.valid) {
        showError(nikInput, 'Format NIK tidak valid');
        isValid = false;
      } else {
        showSuccess(nikInput);

        const inputDob = document.getElementById('dob');
        const dob = inputDob.value.split('-');
        const tanggalLahir = validationResponse.tanggalLahir;
        const bulanLahir = validationResponse.bulanLahir;
        const tahunLahir = validationResponse.tahunLahir;
        
        if (inputDob.value === '') {
          showError(inputDob, 'Tanggal Lahir harus diisi');
          isValid = false;
        } else if (dob[2] !== tanggalLahir || dob[1] !== bulanLahir || dob[0].substr(2) !== tahunLahir) {
          showError(inputDob, 'Tanggal Lahir tidak sesuai dengan NIK');
          isValid = false;
        } else {
          showSuccess(inputDob);
        }
      }
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