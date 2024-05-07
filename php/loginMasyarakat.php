<?php
require 'functions.php';
if(loginMasyarakat($_POST)) {
    echo "
        <script>
            alert('Selamat Datang Kembali!');
            window.location.href = 'dashboardMasyarakat.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Akun yang Anda masukkan belum terdaftar!');
            window.location.href = '../loginMasyarakat.html';
        </script>
    ";
}
?>