<?php
require 'functions.php';
if(loginAdminandGov($_POST) == 1) {
    echo "
        <script>
            alert('Selamat Datang Min!');
            window.location.href = 'dashboardAdmin.php';
        </script>
    ";
} else if (loginAdminandGov($_POST) == 0){
    echo "
        <script>
            alert('Selamat Datang Pak/Bu!');
            window.location.href = 'dashboardGoverment.php';
        </script>
    ";
}else {
    echo "
        <script>
            alert('Access denied!');
            window.location.href = '../loginAdminandGov.html';
        </script>
    ";
}
?>