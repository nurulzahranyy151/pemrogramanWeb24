<?php
require 'functions.php';
if(login($_POST)) {
    echo "
        <script>
            alert('Selamat Datang Kembali!');
            window.location.href = '../dashboard.html';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Akun yang Anda masukkan belum terdaftar!');
            window.location.href = '../login.html';
        </script>
    ";
}
?>