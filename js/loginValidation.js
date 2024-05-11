window.onload = function() {
    document.getElementById("form").onsubmit = function() {
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;

        if (email.trim() === "" && password.trim() === "") {
            alert("Masukkan Email dan Password Anda.");
            return false;
        } else if(email.trim() === "") {
            alert("Masukkan Email Anda.");
            return false;
        } else if(password.trim() === "") {
            alert("Masukkan Password Anda.");
            return false;
        } else {
            return true;
        }
    };
};
