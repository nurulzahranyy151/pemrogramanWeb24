<?php
require 'functions.php';
if(sign($_POST) == 1){
    echo "
        <script>
            alert('data berhasil ditambahkan!');
            window.location.href = '../loginMasyarakat.html'
        </script>
    ";
} else if(sign($_POST) == 0){
    echo "
        <script>
            alert('NIK sudah digunakan!');
            window.location.href = '../sign-upMasyarakat.html'
        </script>
    ";
} else{
    echo "
    <script>
        alert('Sistem error!');
        window.location.href = '../sign-upMasyarakat.html'
    </script>
    ";
}
?>