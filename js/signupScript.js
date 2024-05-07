document.addEventListener("DOMContentLoaded", function(){

  const form = document.getElementById("form");
  const username = document.getElementById("username");
  const email = document.getElementById("email");
  const password = document.getElementById("password");
  const password2 = document.getElementById("password2");

  const setError = (element, message) => {
    const inputcontrol = element.parentElement;
    const displayerror = inputcontrol.querySelector(".error");
    displayerror.innerText = message;
    inputcontrol.classList.add("error");
    inputcontrol.classList.remove("success");
  };

  const setSuccess = (element) => {
    const inputcontrol = element.parentElement;
    inputcontrol.classList.remove("error");
    inputcontrol.classList.add("success");
  };

  const validateInput = () => {
    const usernamevalue = username.value.trim();
    const emailvalue = email.value.trim();
    const passwordvalue = password.value.trim();
    const password2value = password2.value.trim();

    if (usernamevalue === "") {
      setError(username, "Username tidak boleh kosong");
    } else {
      setSuccess(username);
    }

    if (emailvalue === "") {
      setError(email, "Email wajib diisi");
    } else {
      setSuccess(email);
    }

    if (passwordvalue === "") {
      setError(password, "Password wajib diisi");
    } else if (passwordvalue.length < 8) {
      setError(password, "Password harus terdiri dari paling sedikit 8 karakter");
    } else {
      setSuccess(password);
    }

    if (password2value === "") {
      setError(password2, "Password wajib diisi");
    } else if (password2value !== passwordvalue) {
      setError(password2, "Password tidak sesuai");
    } else {
      setSuccess(password2);
    }
  };

  /*form.addEventListener("button", (e) => {
    e.preventDefault();
    validateInput();
  }); */
});
