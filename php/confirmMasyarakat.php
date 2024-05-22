<?php
require 'functions.php';
$loginResult = loginMasyarakat($_POST);
if ($loginResult == 1) {
    header("Location: ../masyarakat/dashboard.php");
    exit();
} else {
    header("Location: ../loginMasyarakat.php?error=1");
    exit();
}
?>
