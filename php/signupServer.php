<?php
require 'functions.php';
if(sign($_POST) > 0){
    echo "
        <script>
            alert('data berhasil ditambahkan!');
            window.location.href = '../login.html'
        </script>
    ";
} else if(sign($_POST) == 0){
    echo "
        <script>
            alert('NIK sudah digunakan!');
            window.location.href = '../sign-up.html'
        </script>
    ";
} else{
    echo "
    <script>
        alert('Sistem error!');
        window.location.href = '../sign-up.html'
    </script>
";
}
?>